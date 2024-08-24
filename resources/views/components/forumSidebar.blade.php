<div class="flex min-h-12 justify-center items-center bg-white lg:hidden border w-full p-3">
    <button data-modal-target="navbar-forum" data-modal-toggle="navbar-forum" type="button"
        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
        <span class="sr-only">Open main menu</span>
        <svg class="w-7 h-7 text-custom-purple" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M1 1h15M1 7h15M1 13h15" />
        </svg>
    </button>
</div>

<div id="navbar-forum" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Menu Forum
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="navbar-forum">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <div class="flex flex-col items-center px-10 lg:bg-transparent">
                    @include('components.forumSidebarList')
                </div>
            </div>
        </div>
    </div>
</div>

{{-- sidebar md --}}
<div class="hidden lg:flex flex-col items-center pt-10 md:pt-36 w-64 lg:min-w-96 px-10 bg-slate-100 md:bg-transparent">
    @include('components.forumSidebarList')
    <div class="grid grid-flow-row h-fit mt-10">
        <div class="md:hidden text-xl font-bold mb-6">Produk yang mungkin anda suka</div>
        <div
            class="grid grid-flow-col justify-center md:grid-flow-row gap-4 pb-4 overflow-x-auto md:overflow-x-visible ">
            @foreach ($produks as $produk)
                <div
                    class="bg-white text-start p-8 px-2 md:mt-10 border-2 rounded-lg shadow-md transition duration-700 ease-in-out w-56 transform hover:scale-105 hover:border-custom-purple">
                    <div class="border-b border-custom-purple text-center font-semibold">Ads</div>
                    <a href="{{ route('produk.detail-produk', ['produk_id' => $produk->produk_id]) }}">
                        <div class="flex flex-col justify-between h-full">
                            <div class="flex justify-center p-2">
                                <img src="{{ asset('storage/gambarproduk1/' . $produk->foto_produk1) }}"
                                    class="h-32 md:h-48"
                                    data-src="{{ asset('storage/gambarproduk1/' . $produk->foto_produk1) }}">
                            </div>
                            <hr class="h-px mb-2 bg-gray-400 border-0">
                            <div class="flex-grow">
                                <p class="text-lg font-semibold mb-1 break-words">
                                    {{ $produk->brand->nama_brand }}
                                </p>
                                <p class="text-gray-700 break-words text-xs mb-1 capitalize text-justify">
                                    {{ $produk->nama_produk }} - {{ $produk->warna_produk }}
                                </p>
                            </div>

                            <div class="flex-grow p-1">
                                <div class="flex-grow grid grid-cols-3">
                                    <p
                                        class="text-xs  text-center flex justify-center items-center h-5 rounded-xl text-white @if ($produk->jenis_kelamin_produk == 'Wanita') bg-red-400 @elseif($produk->jenis_kelamin_produk == 'Pria') bg-blue-400 @elseif($produk->jenis_kelamin_produk == 'Unisex') bg-yellow-300 @endif">
                                        {{ $produk->jenis_kelamin_produk }}</p>
                                    <p
                                        class="text-xs ml-1 h-5 rounded-lg  text-white bg-custom-purple text-center flex justify-center items-center">
                                        {{ $produk->ukuran_produk }}</p>
                                </div>
                                <div class="mt-auto">
                                    <p
                                        class="text-{{ $produk->diskon_produk != 0 ? 'red-400' : 'black mb-3' }} break-words text-base font-bold">
                                        Rp. {{ number_format($produk->harga_akhir_produk, 0, ',', '.') }}
                                    </p>
                                </div>
                                <div class="">
                                    <p
                                        class="text-gray-700 break-words text-sm font-normal {{ $produk->diskon_produk != 0 ? 'line-through' : 'hidden' }}">
                                        Rp. {{ number_format($produk->harga_produk, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
