<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Raja Ongkir V2</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <style>
        .loader{border:4px solid #f3f3f3;border-top:4px solid #4f46e5;border-radius:50%;width:30px;height:30px;animation:spin 1s linear infinite;margin:0 auto;display:none}@keyframes spin{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}
    </style>
</head>
<body class="bg-gray-200 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white p-8 rounded-xl shadow w-full max-w-2xl">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Your Address</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

            <!-- Dropdown Provinsi -->
            <div>
                <label for="province" class="block text-sm font-medium text-gray-700 mb-1">Provinsi Tujuan</label>
                <select id="province" name="province_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base bg-gray-200 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md shadow">
                    <option value="">-- Pilih Provinsi --</option>
                    @foreach($provinces as $province)
                    <option value="{{ $province['id'] }}">{{ $province['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Dropdown Kota / Kabupaten -->
            <div>
                <label for="city" class="block text-sm font-medium text-gray-700 mb-1">Kota / Kabupaten Tujuan</label>
                <select id="city" name="city_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base bg-gray-200 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md shadow-sm disabled:bg-gray-50 disabled:cursor-not-allowed">
                    <option value="">-- Pilih Kota / Kabupaten --</option>
                </select>
            </div>

            <!-- Dropdown Kecamatan -->
            <div>
                <label for="district" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan Tujuan</label>
                <select id="district" name="district_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base bg-gray-200 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md shadow-sm disabled:bg-gray-50 disabled:cursor-not-allowed">
                    <option value="">-- Pilih Kecamatan --</option>
                </select>
            </div>

        </div>

        <div class="mb-6">
            <label for="street_address" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap (opsional)</label>
            <textarea id="street_address" name="street_address" rows="2" placeholder="Jalan, RT/RW, No. Rumah" class="mt-1 block w-full pl-3 pr-3 py-2 text-base bg-gray-200 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md shadow"></textarea>
        </div>

        <!-- Courier and weight removed — page now saves address only -->

                <div class="flex justify-center mb-8 flex-col items-center">
            <button class="btn-check w-full md:w-auto px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed">
                Simpan Alamat
            </button>
            <div class="loader mt-4" id="loading-indicator"></div>
        </div>

        <div id="save-result" class="mt-4 text-center text-green-700 hidden"></div>

        <script>
            $(document).ready(function() {

                // Fungsi formatCurrency
                function formatCurrency(amount) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0
                    }).format(amount);
                }

                // Inisialisasi dropdown kota/kabupaten
                $('select[name="province_id"]').on('change', function() {
                    let provinceId = $(this).val();
                    if (provinceId) {
                        jQuery.ajax({
                            url: `/cities/${provinceId}`,
                            type: "GET",
                            dataType: "json",
                            success: function(response) {
                                $('select[name="city_id"]').empty();
                                $('select[name="city_id"]').append(`<option value="">-- Pilih Kota / Kabupaten --</option>`);
                                $.each(response, function(index, value) {
                                    $('select[name="city_id"]').append(`<option value="${value.id}">${value.name}</option>`);
                                });
                            }
                        });
                    } else {
                        $('select[name="city_id"]').append(`<option value="">-- Pilih Kota / Kabupaten --</option>`);
                    }
                });

                // Inisialisasi dropdown kecamatan
                $('select[name="city_id"]').on('change', function() {
                    let cityId = $(this).val();
                    if (cityId) {
                        jQuery.ajax({
                            url: `/districts/${cityId}`,
                            type: "GET",
                            dataType: "json",
                            success: function(response) {
                                $('select[name="district_id"]').empty();
                                $('select[name="district_id"]').append(`<option value="">-- Pilih Kecamatan --</option>`);
                                $.each(response, function(index, value) {
                                    $('select[name="district_id"]').append(`<option value="${value.id}">${value.name}</option>`);
                                });
                            }
                        });
                    } else {
                        $('select[name="district_id"]').append(`<option value="">-- Pilih Kecamatan --</option>`);
                    }
                });

                // ajax save address
                let isProcessing = false;

                $('.btn-check').click(function (e) {
                    e.preventDefault();

                    if (isProcessing) return;

                    let token        = $("meta[name='csrf-token']").attr("content");
                    let province_id  = $('select[name=province_id]').val();
                    let city_id      = $('select[name=city_id]').val();
                    let district_id  = $('select[name=district_id]').val();
                    let street_address = $('#street_address').val();

                    // Validasi form
                    if (!province_id || !city_id || !district_id) {
                        alert('Harap pilih provinsi, kota, dan kecamatan terlebih dahulu!');
                        return;
                    }

                    isProcessing = true;
                    
                    // Tampilkan loading indicator
                    $('#loading-indicator').show();
                    $('.btn-check').prop('disabled', true);
                    $('.btn-check').text('Menyimpan...');

                    $.ajax({
                        url: "/save-address",
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            _token: token,
                            province_id: province_id,
                            city_id: city_id,
                            district_id: district_id,
                            street_address: street_address,
                        },
                        success: function (response) {
                            if (response && response.address) {
                                $('#save-result').removeClass('hidden').text('Alamat berhasil disimpan.');
                            } else if (response && response.message) {
                                $('#save-result').removeClass('hidden').text(response.message);
                            } else {
                                $('#save-result').removeClass('hidden').text('Alamat berhasil disimpan.');
                            }
                        },
                        error: function (xhr) {
                            console.error('Gagal menyimpan alamat:', xhr.responseText || xhr.statusText);
                            let msg = 'Terjadi kesalahan saat menyimpan alamat.';
                            if (xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
                            $('#save-result').removeClass('hidden').text(msg).addClass('text-red-700');
                        },
                        complete: function () {
                            // Sembunyikan loading indicator
                            $('#loading-indicator').hide();
                            $('.btn-check').prop('disabled', false);
                            $('.btn-check').text('Simpan Alamat');
                            
                            // pastikan tombol bisa diklik kembali
                            isProcessing = false;
                        }
                    });
                });

            });
        </script>

    </body>
</html>
