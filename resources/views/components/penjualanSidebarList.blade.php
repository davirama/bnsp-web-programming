{{-- <button
                        class="hidden md:block border border-custom-purple text-custom-purple font-bold w-full whitespace-nowrap py-2 px-5 mt-5 rounded-md mb-10">
                        Start New Forum
                        <span class="custom-ease-in absolute bg-custom-purple top-0 left-0 w-0 h-full"></span>
                    </button> --}}
<a href="{{ url('/forum') }}"
    class="hidden md:flex justify-center items-center border border-custom-purple text-custom-midnight font-bold text-center w-full whitespace-nowrap py-2 px-5 mt-5 rounded-md mb-10 relative overflow-hidden hover:text-white ease-linear duration-300">
    <div class="z-10">
        <span class="material-symbols-outlined ms-2 me-4">
            add
        </span>
        Ajukan Preloved
    </div>
    <span class="custom-ease-in absolute bg-custom-purple top-0 left-0 w-0 h-full"></span>
</a>
<a href="{{ url('/forum') }}"
    class="flex items-center text-custom-midnight font-semibold text-center w-full whitespace-nowrap py-2 rounded-lg relative overflow-hidden hover:text-white ease-linear duration-300 {{ request()->is('forum') ? 'text-white bg-custom-purple' : '' }}">
    <div class="flex items-center z-10 py-1 px-2">
        <span class="material-symbols-outlined ms-2 me-4">
            forum
        </span>
        Explore Forum
    </div>
    <span class="custom-ease-in absolute bg-custom-purple top-0 left-0 w-0 h-full"></span>
</a>
<div class="border w-full my-5"></div>
<a href="#"
    class="flex items-center text-custom-midnight font-semibold text-center w-full whitespace-nowrap py-2 mb-3 rounded-lg relative overflow-hidden hover:text-white ease-linear duration-300">
    <div class="flex items-center z-10 py-1 px-2">
        <span class="material-symbols-outlined ms-2 me-4">
            Forum
        </span>
        Forum Saya
    </div>
    <span class="custom-ease-in absolute bg-custom-purple top-0 left-0 w-0 h-full"></span>
</a>
<a href="#"
    class="flex items-center text-custom-midnight font-semibold text-center w-full whitespace-nowrap py-2 mb-3 rounded-lg relative overflow-hidden hover:text-white ease-linear duration-300">
    <div class="flex items-center z-10 py-1 px-2">
        <span class="material-symbols-outlined ms-2 me-4">
            prompt_suggestion
        </span>
        Comment Saya
    </div>
    <span class="custom-ease-in absolute bg-custom-purple top-0 left-0 w-0 h-full"></span>
</a>
<a href="#"
    class="flex items-center text-custom-midnight font-semibold text-center w-full whitespace-nowrap py-2 mb-3 rounded-lg relative overflow-hidden hover:text-white ease-linear duration-300">
    <div class="flex items-center z-10 py-1 px-2">
        <span class="material-symbols-outlined ms-2 me-4">
            favorite
        </span>
        Likes Saya
    </div>
    <span class="custom-ease-in absolute bg-custom-purple top-0 left-0 w-0 h-full"></span>
</a>
<a href="#"
    class="flex items-center text-custom-midnight font-semibold text-center w-full whitespace-nowrap py-2 mb-3 rounded-lg relative overflow-hidden hover:text-white ease-linear duration-300">
    <div class="flex items-center z-10 py-1 px-2">
        <span class="material-symbols-outlined ms-2 me-4">
            person_alert
        </span>
        Report Saya
    </div>
    <span class="custom-ease-in absolute bg-custom-purple top-0 left-0 w-0 h-full"></span>
</a>
