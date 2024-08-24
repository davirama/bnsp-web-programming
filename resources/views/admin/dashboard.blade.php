@extends('layouts.main')

@section('contentMain')
    <div class="flex justify-center bg-white">
        <div class="bg-white rounded-lg shadow-lg p-8 mx-4 md:mx-auto w-full max-w-md md:max-w-lg lg:max-w-xl">
            <h1 class="text-center text-3xl font-bold mb-6">Selamat Datang, {{ $account->email }}</h1>

            <div class="flex flex-col justify-center gap-3 p-3">
                <button>
                    <a href="/listakunpengguna"
                        class="p-2 rounded-md bg-green-500 text-white font-semibold flex items-center justify-center space-x-2">
                        <span class="material-symbols-outlined"> description </span>
                        <span>List Akun Pengguna</span>
                    </a>
                </button>
                <button>
                    <a href=""
                        class="p-2 rounded-md bg-red-500 text-white font-semibold flex items-center justify-center space-x-2">
                        <span class="material-symbols-outlined"> download </span>
                        <span>List Akun Pendaftar</span>
                    </a>
                </button>

            </div>

        </div>
    </div>
@endsection
