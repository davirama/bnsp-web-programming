<button id="dropdownMenuIconHorizontalButton{{ $forumResponse->forum_response_id }}"
    data-dropdown-toggle="dropdownDotsHorizontal{{ $forumResponse->forum_response_id }}"
    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50"
    type="button">
    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
        <path
            d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
    </svg>
</button>


<!-- Dropdown menu -->
<div id="dropdownDotsHorizontal{{ $forumResponse->forum_response_id }}"
    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
        aria-labelledby="dropdownMenuIconHorizontalButton{{ $forumResponse->forum_response_id }}">
        @auth
            @if ($forumResponse->accountUser->email_user == auth()->user()->email_user)
                <!-- Check if authenticated user is the author -->
                <li>
                    <button type="button" class="flex items-center px-4 py-2 w-full hover:text-custom-yellow"
                        data-bs-toggle="modal" data-modal-target="update-modal{{ $forumResponse->forum_response_id }}"
                        data-modal-toggle="update-modal{{ $forumResponse->forum_response_id }}">
                        <span class="material-symbols-outlined mr-2">
                            edit
                        </span>
                        Edit Response
                    </button>
                </li>
                <li>
                    <form action="{{ route('forum-responses.destroy', $forumResponse->forum_response_id) }}" method="POST"
                        id="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="flex items-center px-4 py-2 w-full hover:text-custom-red "
                            onclick="return confirm('Apakah Anda yakin ingin menghapus jawaban anda ini?')"><span
                                class="material-symbols-outlined mr-2">
                                delete
                            </span>
                            Hapus
                        </button>
                    </form>
                </li>
            @else
                <!-- If authenticated user is not the author -->
                @php
                    $userReportedForumResponse = $userReportForumResponses->contains(function ($report) use (
                        $forumResponse,
                    ) {
                        return $report->forum_response_id == $forumResponse->forum_response_id;
                    });
                @endphp
                <li>
                    @if (!$userReportedForumResponse)
                        <button type="button"
                            data-modal-target="reportForumResponseModal{{ $forumResponse->forum_response_id }}"
                            data-modal-toggle="reportForumResponseModal{{ $forumResponse->forum_response_id }}"
                            class="flex items-center px-4 py-2 w-full hover:text-custom-red">
                            <span class="material-symbols-outlined mr-2">report</span>
                            Report
                        </button>
                    @else
                        <div class="flex items-center px-4 py-2 w-full hover:text-custom-red">
                            <span class="material-symbols-outlined mr-2">report_off</span>
                            Reported
                        </div>
                    @endif
                </li>
            @endif
        @else
            <!-- If user is not authenticated -->
            <li>
                <button type="button" data-modal-target="reportForumResponseModal{{ $forumResponse->forum_response_id }}"
                    data-modal-toggle="reportForumResponseModal{{ $forumResponse->forum_response_id }}"
                    class="flex items-center px-4 py-2 w-full hover:text-custom-red">
                    <span class="material-symbols-outlined mr-2">report</span>
                    Report
                </button>
            </li>
        @endauth
        @if (auth()->check() && auth()->user()->email_user == $forumResponse->forum->email_user)
            {{-- if user is the author of the forum  --}}
            @if ($forum->validated == 0)
                <li>
                    <form action="{{ route('forum.solve', [$forum->forum_id, $forumResponse->forum_response_id]) }}"
                        method="POST" id="solve-form">
                        @csrf
                        <button type="submit" class="flex items-center px-4 py-2 w-full hover:text-custom-red "
                            onclick="return confirm('Apakah Anda yakin ingin menyelesaikan Forum ini?')"><span
                                class="material-symbols-outlined mr-2">
                                add_task
                            </span>
                            solve
                        </button>
                    </form>
                </li>
            @endif
        @endif
    </ul>
</div>
<div id="reportForumResponseModal{{ $forumResponse->forum_response_id }}" tabindex="-1" aria-hidden="true"
    data-modal-target="reportForumResponseModal{{ $forumResponse->forum_response_id }}"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-md md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <button type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                data-modal-toggle="reportForumResponseModal{{ $forumResponse->forum_response_id }}">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 ">Report Forum Response</h3>
                <form method="POST" action="{{ route('report.forum.responses.store') }}">
                    @csrf
                    <input type="hidden" name="forum_response_id" value="{{ $forumResponse->forum_response_id }}">
                    <div class="mb-4">
                        <label for="reason" class="block text-sm font-medium text-custom-midnight">Alasan
                            Mereport</label>
                        <select name="reason"
                            class="reason-select block w-full px-3 py-2 mt-1 text-sm border border-gray-900 text-custom-midnight rounded-lg focus:ring-custom-midnight focus:border-custom-midnight"
                            required>
                            <option value="" disabled selected>Select a reason</option>
                            <option value="Spam atau Misleading">Spam atau Misleading</option>
                            <option value="Bullying atau Mengganggu">Bullying atau Mengganggu</option>
                            <option value="Ujaran Kebencian atau Kekerasan">Ujaran Kebencian atau Kekerasan</option>
                            <option value="Content yang Tidak Pantas">Content yang Tidak Pantas</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-4 other-reason-container hidden">
                        <label for="other_reason" class="block text-sm font-medium text-custom-midnight">Tulis Alasan
                            Mereport</label>
                        <textarea
                            class="other-reason block w-full px-3 py-2 mt-1 text-sm border border-gray-900 text-custom-midnight rounded-lg focus:ring-custom-midnight focus:border-custom-midnight"
                            placeholder="Describe the issue"></textarea>
                    </div>
                    <x-custom-purple-button btnType="submit" text="Report" />
                </form>
            </div>
        </div>
    </div>
</div>


<!-- update modal -->
<div id="update-modal{{ $forumResponse->forum_response_id }}" tabindex="-1" aria-hidden="true"
    data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow text-left">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b border-custom-purple rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Edit Response anda
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-toggle="update-modal{{ $forumResponse->forum_response_id }}">
                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5"
                action="{{ route('forum-responses.update', $forumResponse->forum_response_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="response{{ $forumResponse->forum_response_id }}"
                            class="block mb-2 text-sm font-medium text-gray-900">
                            Response Anda</label>
                        <textarea class="summernote-editor form-control" name="response" rows="6" required>{{ old('response', $forumResponse->response) }}</textarea>
                    </div>
                </div>
                <div class="flex justify-center">
                    <button type="submit"
                        class="text-white inline-flex items-center bg-custom-purple hover:bg-custom-midnight focus:ring-4 focus:outline-none focus:ring-custom-red font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Edit Response Saya
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var $jq = jQuery.noConflict();
    $jq(document).ready(function() {
        $jq('.summernote-editor').each(function() {
            $jq(this).summernote({
                placeholder: 'Masukkan Response',
                tabsize: 2,
                height: 300,
            });
        });
    });
</script>


{{-- SCRIPT UNTUK REPORT --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.reason-select').forEach(function(selectElement) {
            selectElement.addEventListener('change', function() {
                var reasonSelect = this;
                var form = reasonSelect.closest('form');
                var otherReasonContainer = form.querySelector('.other-reason-container');
                var otherReasonTextarea = form.querySelector('.other-reason');

                if (reasonSelect.value === 'Other') {
                    reasonSelect.removeAttribute('name');
                    otherReasonContainer.classList.remove('hidden');
                    otherReasonTextarea.setAttribute('name', 'reason');
                    otherReasonTextarea.setAttribute('required', 'required');
                } else {
                    reasonSelect.setAttribute('name', 'reason');
                    otherReasonContainer.classList.add('hidden');
                    otherReasonTextarea.removeAttribute('name');
                    otherReasonTextarea.removeAttribute('required');
                }
            });
        });
    });
</script>
