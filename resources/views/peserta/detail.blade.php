@extends('layouts.main')

@section('contentMain')
    <div class="flex justify-center">
        <button type="submit" onclick="downloadPdf()"
            class="w-full bg-blue-600 text-white max-w-4xl text-sm font-medium rounded-lg p-2.5 focus:outline-none focus:ring-4 focus:ring-blue-300">Print
            Formulir Pendaftaran</button>
    </div>
    <div class="flex justify-center  bg-white" id="printform">
        <div class="bg-white rounded-lg shadow-lg p-1 mx-4 md:mx-auto w-full max-w-md md:max-w-lg lg:max-w-5xl">
            <h1 class="text-center text-xl font-bold">Formulir Bukti Pendaftaran</h1>
            <div class=" flex justify-center">
                <div class="mt-2">
                    <img id="foto-preview" src="{{ asset('storage/foto/' . $account->foto) }}" alt="Foto"
                        class="h-40 object-cover {{ $account->foto ? '' : 'hidden' }}">

                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-5">
                <div class="p-2  border-r border-gray-300">
                    <div class="mb-2">
                        <label for="nama_lengkap" class="block mb-2 text-sm font-medium text-gray-700">Nama Lengkap
                            (Sesuai Ijazah Disertai Gelar)</label>
                        <input type="nama_lengkap"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required value="{{ $account->nama_lengkap }}" disabled />
                    </div>
                    <div class="mb-2">
                        <label for="nisn" class="block mb-2 text-sm font-medium text-gray-700">NISN</label>
                        <input type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            disabled value="{{ $account->nisn }}" oninput="validateNumberInput(this)" required disabled />
                    </div>
                    <div class="mb-2">
                        <label for="alamat_ktp" class="block mb-2 text-sm font-medium text-gray-700">Alamat Berdasarkan
                            KTP</label>
                        <textarea type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required disabled>{{ $account->address_ktp }}</textarea>
                    </div>
                    <div class="mb-2">
                        <label for="alamat_now" class="block mb-2 text-sm font-medium text-gray-700">Alamat Saat
                            Ini</label>
                        <textarea type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required disabled>{{ $account->address_now }}</textarea>
                    </div>
                    <div class="mb-2">
                        <label for="kecamatan" class="block mb-2 text-sm font-medium text-gray-700">Kecamatan</label>
                        <input type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{ $account->kecamatan }}" required disabled />
                    </div>

                    <div class="mb-2">
                        <label for="provinsi" class="block mb-2 text-sm font-medium text-gray-700">Provinsi</label>
                        <input type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{ $account->province->province }}" required disabled />
                    </div>

                    <div class="mb-2">
                        <label for="kota" class="block mb-2 text-sm font-medium text-gray-700">Kota/Kabupaten</label>
                        <input type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{ $account->city->city_name }}" required disabled />
                    </div>
                    <div class="mb-2">
                        <label for="telp_number" class="block mb-2 text-sm font-medium text-gray-700">Nomor
                            Telepon</label>
                        <input type="tel"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{ $account->telp_number }}" required oninput="validateNumberInput(this)" disabled />
                    </div>
                    <div class="mb-2">
                        <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-700">Nomor
                            Handphone</label>
                        <input type="tel"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{ $account->phone_number }}" oninput="validateNumberInput(this)" required disabled />
                    </div>
                    <div class="mb-2">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                        <input type="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required value="{{ $account->email }}" disabled />
                    </div>
                </div>
                <div class="p-2">

                    <div class="mb-2">
                        <label for="tgl_lahir" class="block mb-2 text-sm font-medium text-gray-700">Tanggal Lahir
                            (Sesuai Ijazah)</label>
                        <input type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required value="{{ $account->tgl_lahir }}" disabled />
                    </div>
                    <div class="mb-2">
                        <label for="kewarganegaraan"
                            class="block mb-2 text-sm font-medium text-gray-700">Kewarganegaraan</label>
                        <input type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required value="{{ $account->kewarganegaraan }}" disabled />
                    </div>

                    @if (auth()->user()->kewarganegaraan == 'wna')
                        <div class="mb-2" id="nama_kewarganegaraan_container">
                            <label for="nama_kewarganegaraan" class="block mb-2 text-sm font-medium text-gray-700">Nama
                                Negara
                                Kewarganegaraan</label>
                            <input type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                value="{{ $account->nama_kewarganegaraan }}" required disabled />
                        </div>
                        <div id="negara_lahir_container" class="mb-2">
                            <label for="negara_lahir" class="block mb-2 text-sm font-medium text-gray-700">Tempat Lahir
                                Luar
                                Negeri</label>
                            <input type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                value="{{ $account->negara_lahir }}" disabled />
                        </div>
                    @else
                        <div class="mb-2">
                            <label for="province_id_lahir" class="block mb-2 text-sm font-medium text-gray-700">Provinsi
                                Kelahiran</label>
                            <input type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                value="{{ $account->province->province }}" required disabled />
                        </div>

                        <div class="mb-2">
                            <label for="city_id_lahir" class="block mb-2 text-sm font-medium text-gray-700">Kota/Kabupaten
                                Kelahiran</label>
                            <input type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                value="{{ $account->city->city_name }}" required disabled />
                        </div>

                        <div class="mb-2">
                            <label for="tempat_lahir" class="block mb-2 text-sm font-medium text-gray-700">Tempat Lahir
                                (Sesuai Ijazah)</label>
                            <input type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                value="{{ $account->tempat_lahir }}" required disabled />
                        </div>
                    @endif
                    <div class="mb-2">
                        <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-700">Jenis
                            Kelamin</label>
                        <input type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{ $account->jenis_kelamin }}" disabled />
                    </div>
                    <div class="mb-2">
                        <label for="status_menikah" class="block mb-2 text-sm font-medium text-gray-700">Status
                            Menikah</label>
                        <input type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{ $account->status_menikah }}" disabled />
                    </div>
                    <div class="mb-2">
                        <label for="agama_id" class="block mb-2 text-sm font-medium text-gray-700">Agama</label>
                        <input type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{ $account->agama->name_agama }}" disabled />
                    </div>
                    <!-- Foto -->


                    <!-- Video -->

                </div>
                {{-- </div> --}}
            </div>



        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function downloadPdf() {
            var element = document.getElementById("printform")
            html2pdf().from(element).save()
        }
    </script>
@endsection
