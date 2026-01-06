@extends('layouts.layout', ['title' => $title])

@section('content')
    <h1>Simple Shipping Cost Calculator</h1>

    <form method="GET">
        <div>
            <label>Origin location (name / kecamatan / ZIP):</label>
            <input type="text" name="origin_location"
                   value="{{ request('origin_location') }}"
                   placeholder="ex: Gubeng / Surabaya / 60281">
        </div>
        <br>

        <div>
            <label>Destination location (name / kecamatan / ZIP):</label>
            <input type="text" name="destination_location"
                   value="{{ request('destination_location') }}"
                   placeholder="ex: Cilandak / Jakarta / 12430">
        </div>
        <br>

        <div>
            <label>Weight (grams):</label>
            <input type="number" name="weight"
                   value="{{ request('weight', 1500) }}">
        </div>
        <br>

        <div>
            <label>Courier:</label>
            <input type="text" name="courier"
                   value="{{ request('courier', 'jne') }}"
                   placeholder="jne / jnt / sicepat">
        </div>
        <br>

        <button type="submit">Calculate</button>
    </form>

    <hr>

    @php
        $apiKey   = 's72IdQd181be83daff5b3b131XWfLbkI';

        // Form inputs
        $originKeyword      = trim(request('origin_location', ''));
        $destinationKeyword = trim(request('destination_location', ''));
        $weight             = (int) request('weight', 1500);
        $courier            = request('courier', 'jne');

        // Hardcoded fallback IDs (your test case)
        $fallbackOriginId      = 6644;
        $fallbackDestinationId = 45806;

        $originData      = null;
        $destinationData = null;
        $originId        = $fallbackOriginId;
        $destinationId   = $fallbackDestinationId;
        $shippingResult  = null;
        $errorMessage    = null;

        /**
         * Search helper: returns first destination row or null.
         */
        function ro_search_destination_simple($keyword, $apiKey) {
            if ($keyword === '') return null;

            $curl = curl_init();
            $url  = "https://rajaongkir.komerce.id/api/v1/destination/domestic-destination"
                . "?search=" . urlencode($keyword)
                . "&limit=1&offset=0";

            curl_setopt_array($curl, [
                CURLOPT_URL            => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER     => [
                    "key: $apiKey",
                ],
            ]);

            $response = curl_exec($curl);
            curl_close($curl);

            if ($response === false) {
                return null;
            }

            $data = json_decode($response, true);



            if (!isset($data['data'][0])) {
                return null;
            }

            return $data['data'][0];
        }

        // Try to resolve origin/destination from form, but fall back if not found
        if ($originKeyword !== '' && $destinationKeyword !== '') {
            $originData      = ro_search_destination_simple($originKeyword, $apiKey);
            $destinationData = ro_search_destination_simple($destinationKeyword, $apiKey);

            if ($originData) {
                $originId = $originData['id']; // this is the ID you must send to cost API
            }

            if ($destinationData) {
                $destinationId = $destinationData['id'];
            }

            if (!$originData) {
                $errorMessage = "Origin not found for keyword: " . e($originKeyword) . " (using fallback ID $fallbackOriginId)";
            } elseif (!$destinationData) {
                $errorMessage = "Destination not found for keyword: " . e($destinationKeyword) . " (using fallback ID $fallbackDestinationId)";
            }
        }

        // Call shipping cost API using whatever IDs we ended up with
        $postFields = http_build_query([
            'origin'      => $originId,
            'destination' => $destinationId,
            'weight'      => $weight,
            'courier'     => $courier,
            'price'       => 'lowest',
        ]);

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => 'https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => $postFields,
            CURLOPT_HTTPHEADER     => [
                "key: $apiKey",
                'Content-Type: application/x-www-form-urlencoded',
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        if ($response === false) {
            $errorMessage = "Error calling shipping cost API.";
        } else {
            $shippingResult = json_decode($response, true);
        }
    @endphp

    {{-- Show errors (but still show fallback result if possible) --}}
    @if ($errorMessage)
        <p style="color:red;"><strong>{{ $errorMessage }}</strong></p>
    @endif

    {{-- Show which IDs are being used --}}
    <h3>Used IDs</h3>
    <p>
        <strong>Origin ID:</strong>
        {{ $originId }}
        @if ($originData)
            — {{ $originData['label'] ?? ($originData['subdistrict_name'] ?? '') }}
        @else
            (fallback)
        @endif
    </p>
    <p>
        <strong>Destination ID:</strong>
        {{ $destinationId }}
        @if ($destinationData)
            — {{ $destinationData['label'] ?? ($destinationData['subdistrict_name'] ?? '') }}
        @else
            (fallback)
        @endif
    </p>

    {{-- Show shipping options if data is present --}}
    @if ($shippingResult && !empty($shippingResult['data']) && is_array($shippingResult['data']))
        <h3>Shipping Options</h3>
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>Courier</th>
                <th>Service</th>
                <th>Description</th>
                <th>Cost (Rp)</th>
                <th>ETD</th>
            </tr>
            @foreach ($shippingResult['data'] as $svc)
                <tr>
                    <td>{{ $svc['name'] ?? '' }}</td>
                    <td>{{ $svc['service'] ?? '' }}</td>
                    <td>{{ $svc['description'] ?? '' }}</td>
                    <td>{{ $svc['cost'] ?? '' }}</td>
                    <td>{{ $svc['etd'] ?? '' }}</td>
                </tr>
            @endforeach
        </table>
    @else
        <p>No shipping options returned. Check raw JSON below.</p>
    @endif

    <h4>Raw JSON (Debug)</h4>
    <pre>{{ json_encode($shippingResult, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
@endsection
