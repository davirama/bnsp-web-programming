<div
    class="fixed md:hidden bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200 dark:bg-gray-700 dark:border-gray-600">
    <div class="grid h-full max-w-lg grid-cols-4 mx-auto font-medium">
        <button type="button"
            class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
            <svg class="w-5 h-5 mb-2 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500"
                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
            </svg>
            <span
                class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">Home</span>
        </button>
        <button type="button"
            class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
            <svg class="w-5 h-5 mb-2 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500"
                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M11.074 4 8.442.408A.95.95 0 0 0 7.014.254L2.926 4h8.148ZM9 13v-1a4 4 0 0 1 4-4h6V6a1 1 0 0 0-1-1H1a1 1 0 0 0-1 1v13a1 1 0 0 0 1 1h17a1 1 0 0 0 1-1v-2h-6a4 4 0 0 1-4-4Z" />
                <path
                    d="M19 10h-6a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1Zm-4.5 3.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2ZM12.62 4h2.78L12.539.41a1.086 1.086 0 1 0-1.7 1.352L12.62 4Z" />
            </svg>
            <span
                class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">Wallet</span>
        </button>
        <button type="button"
            class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
            <svg class="w-5 h-5 mb-2 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500"
                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 12.25V1m0 11.25a2.25 2.25 0 0 0 0 4.5m0-4.5a2.25 2.25 0 0 1 0 4.5M4 19v-2.25m6-13.5V1m0 2.25a2.25 2.25 0 0 0 0 4.5m0-4.5a2.25 2.25 0 0 1 0 4.5M10 19V7.75m6 4.5V1m0 11.25a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5ZM16 19v-2" />
            </svg>
            <span
                class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">Settings</span>
        </button>
        <button type="button"
            class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
            <svg class="w-5 h-5 mb-2 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500"
                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
            </svg>
            <span
                class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">Profile</span>
        </button>
    </div>
</div>



{{-- sidebar md --}}
<div
    class="hidden fixed md:flex top-30 left-0 z-0 w-full h-16 bg-white border-t border-gray-200 dark:bg-gray-700 dark:border-gray-600 items-center">
    <div class="flex flex-row mx-16 h-8 font-medium jusify-start">

        <a class="inline-flex " href="{{ route('penjualan.index') }}"><button id=""
                class="category-button min-w-28 md:min-w-36 w-fit me-5  font-medium rounded-lg text-xs px-3 py-2 ring-2  relative overflow-hidden  {{ Str::startsWith(request()->path(), 'penjualan') ? 'text-white bg-custom-yellow ring-custom-yellow' : 'text-custom-yellow ring-custom-yellow hover:text-white' }}   ease-linear duration-300">
                <div class="flex flex-row justify-center w-full ">
                    <div class="inline-flex items-center font-bold z-10 md:whitespace-nowrap w-fit">
                        Pengajuan
                    </div>
                </div>
                <span
                    class="custom-ease-in absolute {{ Str::startsWith(request()->path(), 'penjualan') ? '' : 'bg-custom-yellow' }}  top-0 left-0 w-0 h-full">
                </span>
            </button>
        </a>
        <a class="inline-flex" href="{{ route('penjualan.transaksi.index') }}"><button id=""
                class="category-button min-w-28 md:min-w-36 w-fit me-5 font-medium rounded-lg text-xs px-3 py-2 ring-2  relative overflow-hidden {{ Str::startsWith(request()->path(), 'transaksi') ? 'text-white bg-custom-yellow ring-custom-yellow' : 'text-custom-yellow ring-custom-yellow hover:text-white' }} ease-linear duration-300">
                <div class="flex flex-row justify-center w-full ">
                    <div class="inline-flex items-center font-bold z-10 md:whitespace-nowrap w-fit">
                        Transaksi
                    </div>
                </div>
                <span
                    class="custom-ease-in absolute {{ Str::startsWith(request()->path(), 'transaksi') ? '' : 'bg-custom-yellow' }} top-0 left-0 w-0 h-full"></span>
            </button>
        </a>
        <a class="inline-flex" href="{{ route('riwayat.transaksi.index') }}"><button id=""
                class="category-button min-w-28 md:min-w-36 w-fit me-5 font-medium rounded-lg text-xs px-3 py-2 ring-2  relative overflow-hidden {{ Str::startsWith(request()->path(), 'riwayat') ? 'text-white bg-custom-yellow ring-custom-yellow' : 'text-custom-yellow ring-custom-yellow hover:text-white' }} ease-linear duration-300">
                <div class="flex flex-row justify-center w-full ">
                    <div class="inline-flex items-center font-bold z-10 md:whitespace-nowrap w-fit">
                        Riwayat Transaksi
                    </div>
                </div>
                <span
                    class="custom-ease-in absolute {{ Str::startsWith(request()->path(), 'riwayat') ? '' : 'bg-custom-yellow' }} top-0 left-0 w-0 h-full"></span>
            </button>
        </a>
    </div>
</div>
