<div class="mb-5 p-5 shadow-lg rounded-md border forum-item">
    <div class="flex items-center flex-col md:flex-row">
        <div class="flex-shrink-0">
            <img class="w-12 h-12 rounded-full"
                @if ($forum->accountUser->photo_user != null) src="{{ asset('/storage/photoprofile/' . $forum->accountUser->photo_user) }}"
            @else
            src="{{ asset('img/photoprofile/defaultPhotoProfile.jpg') }}" @endif
                alt="Profile">
        </div>
        <div class="flex-1 min-w-0 ms-4 w-full">
            <a href="{{ route('forum.show', $forum['slug']) }}">
                <div class="text-lg font-bold text-custom-midnight">
                    {{ $forum->judul }}
                </div>
            </a>
            {{-- <div class="text-xs py-10">
                {!! $forum->pertanyaan !!}
            </div> --}}
            <div class="flex mt-5">
                @if ($forum->validated)
                    <div
                        class="flex items-center text-sm max-h-5 font-bold w-fit  rounded-md bg-green-100 text-green-400 p-3 me-3">
                        <span class="material-symbols-outlined me-1">
                            check
                        </span>
                        Solved
                    </div>
                @else
                    <div
                        class="flex items-center text-sm max-h-5 font-bold w-fit  rounded-md bg-slate-400 text-black p-3 me-3">
                        <span class="material-symbols-outlined me-1">
                            unpublished
                        </span>
                        Unsolved
                    </div>
                @endif
                <div
                    class="flex items-center text-sm max-h-5 font-bold w-fit rounded-md border border-custom-yellow text-custom-yellow p-3">
                    {{ $forum->forumCategories->category }}
                </div>
            </div>
        </div>
        <div class="block md:hidden border w-full my-5"></div>
        <div class="ms-0 md:ms-4 flex md:flex-col">
            <div class="flex items-center mb-2 me-2 text-xs font-semibold text-custom-midnight">
                <span class="material-symbols-outlined me-2">
                    schedule
                </span>
                {{ date('d M Y', strtotime($forum->created_at)) }}
            </div>
            <div class="flex items-center mb-2 me-2 text-xs font-semibold text-custom-yellow">
                <span class="material-symbols-outlined me-2">
                    forum
                </span>
                {{ $forum['forum_responses_count'] }} Comment
            </div>
            <x-forum-like-toggle-button :forum=$forum />
        </div>
        <x-forum-dropdown-menu :forum=$forum :userReportForums=$userReportForums />
    </div>
</div>
