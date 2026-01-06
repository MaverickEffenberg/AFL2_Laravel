<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use Illuminate\Support\Facades\Log;


class RajaOngkirController extends Controller
{
    /**
     * Menampilkan daftar provinsi dari API Raja Ongkir
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil data provinsi dari API Raja Ongkir
        $response = Http::withHeaders([

            //headers yang diperlukan untuk API Raja Ongkir
            'Accept' => 'application/json',
            'key' => config('rajaongkir.api_key'),

        ])->get('https://rajaongkir.komerce.id/api/v1/destination/province');

        // Memeriksa apakah permintaan berhasil
        if ($response->successful()) {

            // Mengambil data provinsi dari respons JSON
            // Jika 'data' tidak ada, inisialisasi dengan array kosong
            $provinces = $response->json()['data'] ?? [];
        }

        // returning the view with provinces data
        return view('rajaongkir', compact('provinces'));
    }

    /**
     * Mengambil data kota berdasarkan ID provinsi
     *
     * @param int $provinceId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCities($provinceId)
    {
        // Mengambil data kota berdasarkan ID provinsi dari API Raja Ongkir
        $response = Http::withHeaders([

            //headers yang diperlukan untuk API Raja Ongkir
            'Accept' => 'application/json',
            'key' => config('rajaongkir.api_key'),

        ])->get("https://rajaongkir.komerce.id/api/v1/destination/city/{$provinceId}");

        if ($response->successful()) {

            // Mengambil data kota dari respons JSON
            // Jika 'data' tidak ada, inisialisasi dengan array kosong
            return response()->json($response->json()['data'] ?? []);
        }
    }

    /**
     * Mengambil data kecamatan berdasarkan ID kota
     *
     * @param int $cityId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDistricts($cityId)
    {
        // Mengambil data kecamatan berdasarkan ID kota dari API Raja Ongkir
        $response = Http::withHeaders([

            //headers yang diperlukan untuk API Raja Ongkir
            'Accept' => 'application/json',
            'key' => config('rajaongkir.api_key'),

        ])->get("https://rajaongkir.komerce.id/api/v1/destination/district/{$cityId}");

        if ($response->successful()) {

            // Mengambil data kecamatan dari respons JSON
            // Jika 'data' tidak ada, inisialisasi dengan array kosong
            return response()->json($response->json()['data'] ?? []);
        }
    }

    /**
     * Menghitung ongkos kirim berdasarkan data yang diberikan
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkOngkir(Request $request)
    {
        $payload = $request->validate([
            'province_id' => 'required|integer',
            'city_id' => 'required|integer',
            'district_id' => 'required|integer',
            'courier' => 'required|string',
            'weight' => 'required|integer|min:1',
            'street_address' => 'nullable|string',
        ]);

        // If user is authenticated, save their selected location to addresses table
        if (Auth::check()) {
            try {
                Address::create([
                    'province' => $payload['province_id'] ?? null,
                    'city' => $payload['city_id'] ?? null,
                    'subdistrict' => $payload['district_id'],
                    'street_address' => $payload['street_address'] ?? '',
                    'user_id' => Auth::id(),
                ]);
            } catch (\Throwable $e) {
                Log::warning('Failed to save address: '.$e->getMessage());
            }
        }

        $response = Http::asForm()->withHeaders([

            //headers yang diperlukan untuk API Raja Ongkir
            'Accept' => 'application/json',
            'key'    => config('rajaongkir.api_key'),

        ])->post('https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost', [
                'origin'      => 3855, // ID kecamatan Diwek (ganti sesuai kebutuhan)
                'destination' => $payload['district_id'], // ID kecamatan tujuan
                'weight'      => $payload['weight'], // Berat dalam gram
                'courier'     => $payload['courier'], // Kode kurir (jne, tiki, pos)
        ]);

        if ($response->successful()) {

            // Mengambil data ongkos kirim dari respons JSON
            // Jika 'data' tidak ada, inisialisasi dengan array kosong
            return $response->json()['data'] ?? [];
        }
    }

    /**
     * Save user's address (for authenticated users)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveAddress(Request $request)
    {
        $payload = $request->validate([
            'province_id' => 'required|integer',
            'city_id' => 'required|integer',
            'district_id' => 'required|integer',
            'street_address' => 'nullable|string',
        ]);

      

        try {
            $address = Address::create([
                'province' => $payload['province_id'],
                'city' => $payload['city_id'],
                'subdistrict' => $payload['district_id'],
                'street_address' => $payload['street_address'] ?? '',
                'user_id' => auth()->id(),
            ]);

            return response()->json(['message' => 'Address saved', 'address' => $address]);

        } catch (\Throwable $e) {
            Log::error('Failed to save address: '.$e->getMessage());
            return response()->json(['message' => 'Failed to save address'], 500);
        }
    }
}
