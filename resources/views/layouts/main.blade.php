@extends('layouts.app')

@section('content')
    <div class="">
        <nav class="bg-white border-gray-100 dark:bg-gray-900">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
                </a>
                <button data-collapse-toggle="navbar-default" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
                <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                    <ul
                        class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">

                        <!-- User info -->
                        @auth
                            <li class="flex items-center">
                                <span class="text-white mr-4">{{ Auth::user()->email }}</span>
                                <span class="text-gray-400 mr-4">({{ Auth::user()->role }})</span>
                            </li>
                            @if (isset($account) && $account->role === 'admin')
                                <li>
                                    <form action="{{ route('dashboardadmin') }}" method="GET">
                                        @csrf
                                        <button type="submit" class="block py-2 px-3 text-white rounded ">
                                            Dashboard
                                        </button>
                                    </form>
                                </li>
                            @endif
                            @if (isset($account) && $account->role === 'siswa')
                                <li>
                                    <form action="{{ route('dashboardpeserta') }}" method="GET">
                                        @csrf
                                        <button type="submit" class="block py-2 px-3 text-white ">
                                            Dashboard
                                        </button>
                                    </form>
                                </li>
                            @endif


                            <li>
                                <!-- Logout Button -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="text-white bg-red-500 hover:bg-red-600 px-3 py-2 text-sm uppercase font-bold rounded">
                                        Logout
                                    </button>
                                </form>
                            </li>
                            <li>
                            @else
                            <li>
                                <form action="{{ route('index') }}" method="GET">
                                    @csrf
                                    <button type="submit"
                                        class="block py-2 px-3 text-white rounded bg-blue-500 hover:bg-blue-600">
                                        Login
                                    </button>
                                </form>

                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        {{-- <nav class="bg-gray-800 p-4">
            <div class="container mx-auto flex justify-between items-center">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="text-white text-lg font-bold">
                    MyApp
                </a>

                <!-- Hamburger menu for mobile -->
                <div class="block lg:hidden">
                    <button id="nav-toggle" class="text-white focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>

                <!-- Navbar items -->
                <div class="hidden lg:flex lg:items-center lg:w-auto w-full" id="nav-content">
                    <ul class="flex flex-col lg:flex-row list-none lg:ml-auto">
                        <li class="nav-item">
                            <a href="#" class="text-white px-3 py-2 flex items-center text-sm uppercase font-bold">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="text-white px-3 py-2 flex items-center text-sm uppercase font-bold">
                                About
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="text-white px-3 py-2 flex items-center text-sm uppercase font-bold">
                                Contact
                            </a>
                        </li>
                    </ul>


                </div>
            </div>
        </nav> --}}

        <div class="min-h-screen bg-white p-5   ">
            @yield('contentMain')
        </div>
    </div>

    <script>
        // Toggle menu on small screens
        document.getElementById('nav-toggle').addEventListener('click', function() {
            document.getElementById('nav-content').classList.toggle('hidden');
        });
    </script>
@endsection
