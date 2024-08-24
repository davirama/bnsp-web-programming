<a href="{{ url('/pelanggan/dashboard') }}"
    class="flex items-center text-custom-purple font-semibold text-center w-full whitespace-nowrap py-2 rounded-lg relative overflow-hidden hover:text-white ease-linear duration-500 {{ request()->is('pelanggan/dashboard') ? 'text-white bg-custom-purple' : '' }}">
    <div class="flex items-center z-10 py-1 px-2">
        <span class="material-symbols-outlined ms-2 me-4">
            dashboard
        </span>
        Dashboard
    </div>
    <span class="custom-ease-in absolute bg-custom-purple top-0 left-0 w-0 h-full"></span>
</a>
<div class="border w-full my-5"></div>
<a href="{{ route('checkout.listOrderPelanggan') }}"
    class="flex items-center text-custom-purple font-semibold text-center w-full whitespace-nowrap py-2 mb-3 rounded-lg relative overflow-hidden hover:text-white ease-linear duration-300 {{ request()->is('pelanggan/list-order') ? 'text-white bg-custom-purple' : '' }}">
    <div class="flex items-center z-10 py-1 px-2">
        <span class="material-symbols-outlined ms-2 me-4">
            conveyor_belt
        </span>
        Pesanan Saya
    </div>
    <span class="custom-ease-in absolute bg-custom-purple top-0 left-0 w-0 h-full"></span>
</a>

<a href="{{ route('dashboard.pelanggan.interaksi-avatar.index') }}"
    class="flex items-center text-custom-purple font-semibold text-center w-full whitespace-nowrap py-2 mb-3 rounded-lg relative overflow-hidden hover:text-white ease-linear duration-500 {{ request()->is('pelanggan/dashboard/interaksi-avatar') ? 'text-white bg-custom-purple' : '' }}">
    <div class="flex items-center z-10 py-1 px-2">
        <span class="material-symbols-outlined ms-2 me-4">
            sound_detection_dog_barking
        </span>
        Interaksi Dengan Avatar
    </div>
    <span class="custom-ease-in absolute bg-custom-purple top-0 left-0 w-0 h-full"></span>
</a>

<a href="{{ route('gamifikasi.progressTracker') }}"
    class="flex items-center text-custom-purple font-semibold text-center w-full whitespace-nowrap py-2 mb-3 rounded-lg relative overflow-hidden hover:text-white ease-linear duration-500 {{ request()->is('gamifikasi/progress-tracker') ? 'text-white bg-custom-purple' : '' }}">
    <div class="flex items-center z-10 py-1 px-2">
        <span class="material-symbols-outlined ms-2 me-4">
            stadia_controller
        </span>
        Tracker Badges Gamifikasi
    </div>
    <span class="custom-ease-in absolute bg-custom-purple top-0 left-0 w-0 h-full"></span>
</a>
<a href="{{ route('profile.myProfile') }}"
    class="flex items-center text-custom-purple font-semibold text-center w-full whitespace-nowrap py-2 mb-3 rounded-lg relative overflow-hidden hover:text-white ease-linear duration-500 {{ request()->is('pelanggan/my-profile') ? 'text-white bg-custom-purple' : '' }}">
    <div class="flex items-center z-10 py-1 px-2">
        <span class="material-symbols-outlined ms-2 me-4">
            manage_accounts
        </span>
        Profile Saya
    </div>
    <span class="custom-ease-in absolute bg-custom-purple top-0 left-0 w-0 h-full"></span>
</a>
