{{-- <button
                        class="hidden md:block border border-custom-purple text-custom-purple font-bold w-full whitespace-nowrap py-2 px-5 mt-5 rounded-md mb-10">
                        Start New Forum
                        <span class="custom-ease-in absolute bg-custom-purple top-0 left-0 w-0 h-full"></span>
                    </button> --}}
<a href="{{ route('forum.create') }}"
    class="flex justify-center items-center border border-custom-purple text-custom-purple font-bold text-center w-full whitespace-nowrap py-2 px-5 mt-5 rounded-md mb-10 relative overflow-hidden hover:text-white ease-linear duration-500">
    <div class="z-10 flex items-center">
        <span class="material-symbols-outlined me-2">
            add_circle
        </span>
        Start New Forum
    </div>
    <span class="custom-ease-in absolute bg-custom-purple top-0 left-0 w-0 h-full"></span>
</a>
@guest
    <a href="{{ url('/forum') }}"
        class="flex items-center text-custom-purple font-semibold text-center w-full whitespace-nowrap py-2 rounded-lg relative overflow-hidden hover:text-white ease-linear duration-500 {{ request()->is('forum') ? 'text-white bg-custom-purple' : '' }}">
        <div class="flex items-center z-10 py-1 px-2">
            <span class="material-symbols-outlined ms-2 me-4">
                forum
            </span>
            Explore Forum
        </div>
        <span class="custom-ease-in absolute bg-custom-purple top-0 left-0 w-0 h-full"></span>
    </a>
    <div class="border w-full my-5"></div>
@else
    <a href="{{ url('/forum') }}"
        class="flex items-center text-custom-purple font-semibold text-center w-full whitespace-nowrap py-2 rounded-lg relative overflow-hidden hover:text-white ease-linear duration-500 {{ request()->is('forum') ? 'text-white bg-custom-purple' : '' }}">
        <div class="flex items-center z-10 py-1 px-2">
            <span class="material-symbols-outlined ms-2 me-4">
                forum
            </span>
            Explore Forum
        </div>
        <span class="custom-ease-in absolute bg-custom-purple top-0 left-0 w-0 h-full"></span>
    </a>
    <div class="border w-full my-5"></div>
    <a href="{{ route('forum.myForum') }}"
        class="flex items-center text-custom-purple font-semibold text-center w-full whitespace-nowrap py-2 mb-3 rounded-lg relative overflow-hidden hover:text-white ease-linear duration-500 {{ request()->is('forum/MyForum') ? 'text-white bg-custom-purple' : '' }}">
        <div class="flex items-center z-10 py-1 px-2">
            <span class="material-symbols-outlined ms-2 me-4">
                Forum
            </span>
            Forum Saya
        </div>
        <span class="custom-ease-in absolute bg-custom-purple top-0 left-0 w-0 h-full"></span>
    </a>
    <a href="{{ route('forum.myResponse') }}"
        class="flex items-center text-custom-purple font-semibold text-center w-full whitespace-nowrap py-2 mb-3 rounded-lg relative overflow-hidden hover:text-white ease-linear duration-500 {{ request()->is('forum/MyResponse') ? 'text-white bg-custom-purple' : '' }}">
        <div class="flex items-center z-10 py-1 px-2">
            <span class="material-symbols-outlined ms-2 me-4">
                prompt_suggestion
            </span>
            Comment Saya
        </div>
        <span class="custom-ease-in absolute bg-custom-purple top-0 left-0 w-0 h-full"></span>
    </a>
    <a href="{{ route('forum.myLikedForum') }}"
        class="flex items-center text-custom-purple font-semibold text-center w-full whitespace-nowrap py-2 mb-3 rounded-lg relative overflow-hidden hover:text-white ease-linear duration-500 {{ request()->is('forum/MyLikedForum') ? 'text-white bg-custom-purple' : '' }}">
        <div class="flex items-center z-10 py-1 px-2">
            <span class="material-symbols-outlined ms-2 me-4">
                diagnosis
            </span>
            Forum Yang Disukai
        </div>
        <span class="custom-ease-in absolute bg-custom-purple top-0 left-0 w-0 h-full"></span>
    </a>
    <a href="{{ route('forum.myLikedResponse') }}"
        class="flex items-center text-custom-purple font-semibold text-center w-full whitespace-nowrap py-2 mb-3 rounded-lg relative overflow-hidden hover:text-white ease-linear duration-500 {{ request()->is('forum/MyLikedResponse') ? 'text-white bg-custom-purple' : '' }}">
        <div class="flex items-center z-10 py-1 px-2">
            <span class="material-symbols-outlined ms-2 me-4">
                hr_resting
            </span>
            Jawaban Forum Yang Disukai
        </div>
        <span class="custom-ease-in absolute bg-custom-purple top-0 left-0 w-0 h-full"></span>
    </a>
    <a href="{{ route('forum.myReporting') }}"
        class="flex items-center text-custom-purple font-semibold text-center w-full whitespace-nowrap py-2 mb-3 rounded-lg relative overflow-hidden hover:text-white ease-linear duration-500 {{ request()->is('forum/MyReporting') ? 'text-white bg-custom-purple' : '' }}">
        <div class="flex items-center z-10 py-1 px-2">
            <span class="material-symbols-outlined ms-2 me-4">
                person_alert
            </span>
            Pengajuan Report Saya
        </div>
        <span class="custom-ease-in absolute bg-custom-purple top-0 left-0 w-0 h-full"></span>
    </a>
@endguest
