<div class="flex flex-row justify-center p-3 lg:hidden border lg:border-0">
    <button data-modal-target="navbar-forum" data-modal-toggle="navbar-forum" type="button"
        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-800 rounded-lg xl:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
        <span class="sr-only">Open main menu</span>
        <span class="material-symbols-outlined text-4xl">
            user_attributes
        </span>
    </button>
</div>
{{-- <div class="flex min-h-12 justify-center items-center bg-white md:hidden border w-full p-3">
</div> --}}

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
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
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
            <div class="p-4 md:p-5">
                <div class="flex flex-col items-center md:bg-transparent">
                    @include('components.pelangganDashboardSidebarList')
                </div>
            </div>
        </div>
    </div>
</div>

{{-- sidebar md --}}
<div
    class="hidden lg:flex flex-col items-center pt-10 md:pt-10 w-64 md:min-w-96 px-10 bg-slate-100 md:bg-transparent sticky top-16 h-fit">
    @include('components.pelangganDashboardSidebarList')
</div>
