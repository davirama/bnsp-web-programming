@props(['btnType' => 'button', 'text' => ''])

<button type="{{ $btnType }}"
    class="flex justify-center items-center border border-custom-purple text-custom-midnight font-bold text-center w-full whitespace-nowrap py-2 px-5 mt-5 rounded-md mb-10 relative overflow-hidden hover:text-white ease-linear duration-500">
    <div class="z-10 text-xl">{{ $text }}</div>
    <span class="custom-ease-in absolute bg-custom-purple top-0 left-0 w-0 h-full"></span>
</button>
