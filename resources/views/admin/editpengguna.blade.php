@extends('layouts.main')

@section('contentMain')
    <div class="flex justify-center p-5 bg-white">
        <div
            class="bg-white rounded-lg shadow-lg p-8 md:p-12 lg:p-16 mx-4 md:mx-auto w-full max-w-md md:max-w-lg lg:max-w-xl">
            <h1 class="text-center text-3xl font-bold mb-6">Edit Pengguna</h1>
            <form action="{{ route('updatepengguna', $account->user_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        value="{{ old('email', $account->email) }}" required />
                </div>
                <div class="mb-4">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="••••••••" />
                </div>
                <div class="mb-4">
                    <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="tel" id="phone_number" name="phone_number"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        value="{{ old('phone_number', $account->phone_number) }}" required />
                </div>
                <div class="mb-4">
                    <label for="nisn" class="block mb-2 text-sm font-medium text-gray-700">NISN</label>
                    <input type="text" id="nisn" name="nisn"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        value="{{ old('nisn', $account->nisn) }}" required />
                </div>
                <button type="submit"
                    class="w-full bg-blue-600 text-white font-medium rounded-lg p-2.5 focus:outline-none focus:ring-4 focus:ring-blue-300">Update
                    Pengguna</button>

            </form>
            <form action="{{ route('hapusPengguna', $account->user_id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this user?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="w-full bg-red-600 text-white font-semibold mt-3 py-2 px-4 rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">
                    Hapus Akun
                </button>
            </form>
        </div>
    </div>
@endsection
