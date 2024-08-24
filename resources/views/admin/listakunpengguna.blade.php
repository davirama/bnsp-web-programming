@extends('layouts.main')

@section('contentMain')
    <div class="flex justify-center bg-white p-5">
        <div class="bg-white rounded-lg shadow-lg p-8 mx-4 md:mx-auto w-full max-w-full">
            <h1 class="text-center text-3xl font-bold mb-6">List Akun Pengguna</h1>

            <div class="mb-6">
                <!-- Search and Filter Form -->
                <form method="GET" action="{{ route('listakunpengguna') }}"
                    class="flex flex-col md:flex-row md:items-center gap-4">
                    <!-- Search Input -->
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari email..."
                        class="w-full md:w-1/3 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <!-- Filter Select -->
                    <select name="status_daftar"
                        class="w-full md:w-1/3 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Status</option>
                        <option value="belum melengkapi"
                            {{ request('status_daftar') == 'belum melengkapi' ? 'selected' : '' }}>Belum Melengkapi</option>

                        <option value="Menunggu Validasi Admin"
                            {{ request('status_daftar') == 'Menunggu Validasi Admin' ? 'selected' : '' }}>Menunggu Validasi
                            Admin</option>
                        <option value="tervalidasi" {{ request('status_daftar') == 'tervalidasi' ? 'selected' : '' }}>
                            Tervalidasi</option>

                    </select>

                    <!-- Sort By Email -->
                    <select name="sort_by"
                        class="w-full md:w-1/3 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="asc" {{ request('sort_by') == 'asc' ? 'selected' : '' }}>Sortir Email A-Z</option>
                        <option value="desc" {{ request('sort_by') == 'desc' ? 'selected' : '' }}>Sortir Email Z-A
                        </option>
                    </select>

                    <!-- Apply Button -->
                    <button type="submit"
                        class="w-full md:w-auto bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        Terapkan
                    </button>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">No</th>
                            <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Email</th>
                            <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">NISN</th>
                            <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Phone Number</th>
                            <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Status Daftar</th>
                            <th class="py-2 px-4 text-center text-sm font-medium text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($accounts as $index => $account)
                            <tr>
                                <td class="py-2 px-4 text-sm text-gray-900">{{ $index + 1 }}</td>
                                <td class="py-2 px-4 text-sm text-gray-900">{{ $account->email }}</td>
                                <td class="py-2 px-4 text-sm text-gray-900">{{ $account->nisn }}</td>
                                <td class="py-2 px-4 text-sm text-gray-900">{{ $account->phone_number }}</td>
                                <td class="py-2 px-4 text-sm text-gray-900 capitalize">{{ $account->status_daftar }}</td>
                                <td class="py-2 px-4 text-sm text-gray-900">
                                    <div class="flex justify-center gap-3">
                                        <a href="{{ route('editpengguna', $account->user_id) }}"
                                            class="inline-block bg-yellow-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                                            Edit Akun
                                        </a>

                                        @if ($account->status_daftar == 'Menunggu Validasi Admin')
                                            <a href="{{ route('editpengguna', $account->user_id) }}"
                                                class="inline-block bg-green-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                                                Validasi
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
