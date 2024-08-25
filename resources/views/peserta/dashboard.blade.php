@extends('layouts.main')

@section('contentMain')
    <div class="flex justify-center bg-white">

        <div class="bg-white rounded-lg shadow-lg p-8 mx-4 md:mx-auto w-full max-w-md md:max-w-lg lg:max-w-xl">
            <h1 class="text-center text-3xl font-bold mb-6">Halaman Peserta</h1>
            <div class="text-center">
                Status Anda Saat Ini: <span class="font-semibold capitalize">{{ $account->status_daftar }}</span>
                <br><span class="font-semibold capitalize text-yellow-500">{{ $account->message_status_daftar }}</span>
            </div>
            <div class="flex flex-col justify-center gap-3 p-3">
                @if (auth()->user()->status_daftar != 'tervalidasi')
                    <button>
                        <a href="/formpendaftaran"
                            class="p-2 rounded-md bg-green-500 text-white font-semibold flex items-center justify-center space-x-2">
                            <span class="material-symbols-outlined">
                                description
                            </span>
                            <span>Data Pendaftaran Saya</span>
                        </a>
                    </button>
                @endif
                @if (auth()->user()->status_daftar != 'belum melengkapi')
                    <button>
                        <a href="/detailpeserta"
                            class="p-2 rounded-md bg-red-500 text-white font-semibold flex items-center justify-center space-x-2">
                            <span class="material-symbols-outlined">
                                download
                            </span>
                            <span>Download Bukti Pendaftaran</span>
                        </a>
                    </button>
                @endif

            </div>
        </div>
    </div>
@endsection
