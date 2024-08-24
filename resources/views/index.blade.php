@extends('layouts.main')
@section('contentMain')
    <div class="flex justify-center  bg-white">
        <div
            class="bg-white rounded-lg shadow-lg p-8 md:p-12 lg:p-16 mx-4 md:mx-auto w-full max-w-md md:max-w-lg lg:max-w-xl">
            <h1 class="text-center text-3xl font-bold mb-6">LOGIN PENGGUNA</h1>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email Anda</label>
                    <input type="email" id="email" name="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="name@gmail.com" required />
                </div>
                <div class="mb-6">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-700">Password Anda</label>
                    <input type="password" id="password" name="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="••••••••" required />
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white text-sm font-medium rounded-lg p-2.5 focus:outline-none focus:ring-4 focus:ring-blue-300">Login</button>
            </form>

        </div>
    </div>
@endsection
