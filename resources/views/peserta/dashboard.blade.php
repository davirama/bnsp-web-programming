@extends('layouts.main')

@section('contentMain')
    <div class="flex justify-center bg-white">
        <div
            class="bg-white rounded-lg shadow-lg p-8 md:p-12 lg:p-16 mx-4 md:mx-auto w-full max-w-md md:max-w-lg lg:max-w-xl">
            <h1 class="text-center text-3xl font-bold mb-6">Halaman Peserta</h1>
            <div class="text-center">
                Status Anda Saat Ini: <span class="font-semibold capitalize">{{ $user->status_daftar }}</span>
                <br><span class="font-semibold capitalize text-yellow-500">{{ $user->message_status_daftar }}</span>
            </div>
        </div>
    </div>
@endsection
