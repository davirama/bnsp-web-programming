<div class="md:ml-4 md:border-l border-custom-purple p-2">
    <button id="dropdownMenuIconHorizontalButtonForum{{ $forum->forum_id }}"
        data-dropdown-toggle="dropdownDotsHorizontalForum{{ $forum->forum_id }}"
        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50"
        type="button">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
            <path
                d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
        </svg>
    </button>


    <!-- Dropdown menu -->
    <div id="dropdownDotsHorizontalForum{{ $forum->forum_id }}"
        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
        <ul class="py-2 text-sm text-gray-700"
            aria-labelledby="dropdownMenuIconHorizontalButtonForum{{ $forum->forum_id }}">
            @auth
                @if ($forum->accountUser->email_user == auth()->user()->email_user)
                    {{-- Check if authenticated user is the author --}}
                    <li>
                        <a href="{{ route('forum.edit', $forum->forum_id) }}"
                            class="flex items-center px-4 py-2 w-full hover:text-custom-yellow ">
                            <span class="material-symbols-outlined mr-2">
                                edit
                            </span>
                            Edit
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('forum.delete', $forum->forum_id) }}" method="POST" id="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="flex items-center px-4 py-2 w-full hover:text-custom-red "
                                onclick="return confirm('Apakah Anda yakin ingin menghapus Forum ini?')"><span
                                    class="material-symbols-outlined mr-2">
                                    delete
                                </span>
                                Hapus
                            </button>
                        </form>
                    </li>
                @else
                    {{-- If authenticated user is not the author --}}
                    @php
                        $userReportedForum = $userReportForums->contains(function ($report) use ($forum) {
                            return $report->forum_id == $forum->forum_id;
                        });
                    @endphp
                    <li>
                        @if (!$userReportedForum)
                            <button type="button" data-modal-target="reportForumModal{{ $forum->forum_id }}"
                                data-modal-toggle="reportForumModal{{ $forum->forum_id }}"
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
                {{-- If user is not authenticated --}}
                <li>
                    <button type="button" data-modal-target="reportForumModal{{ $forum->forum_id }}"
                        data-modal-toggle="reportForumModal{{ $forum->forum_id }}"
                        class="flex items-center px-4 py-2 w-full hover:text-custom-red">
                        <span class="material-symbols-outlined mr-2">report</span>
                        Login to Report
                    </button>
                </li>
            @endauth
        </ul>
    </div>
</div>

{{-- REPORT FORUM MODAL  --}}

<div id="reportForumModal{{ $forum->forum_id }}" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-md md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <button type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                data-modal-toggle="reportForumModal{{ $forum->forum_id }}">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900">
                    Report Forum
                </h3>
                <form method="POST" action="{{ route('report.forums.store') }}">
                    @csrf
                    <input type="hidden" name="forum_id" value="{{ $forum->forum_id }}">
                    <div class="mb-4">
                        <label for="reason" class="block text-sm font-medium text-custom-midnight">Alasan
                            Mereport</label>
                        <select name="reason"
                            class="report-forum-reason-select block w-full px-3 py-2 mt-1 text-sm border border-gray-900 text-custom-midnight rounded-lg focus:ring-custom-midnight focus:border-custom-midnight"
                            required>
                            <option value="" disabled selected>Select a reason</option>
                            <option value="Spam atau Misleading">Spam atau Misleading</option>
                            <option value="Bullying atau Mengganggu">Bullying atau Mengganggu</option>
                            <option value="Ujaran Kebencian atau Kekerasan">Ujaran Kebencian atau Kekerasan</option>
                            <option value="Content yang Tidak Pantas">Content yang Tidak Pantas</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-4 hidden other-report-forum-reason-container">
                        <label for="other_reason_reporting_forum"
                            class="block text-sm font-medium text-custom-midnight">Tulis Alasan Mereport</label>
                        <textarea
                            class="other-reason-reporting-forum block w-full px-3 py-2 mt-1 text-sm border border-gray-900 text-custom-midnight rounded-lg focus:ring-custom-midnight focus:border-custom-midnight"
                            placeholder="Describe the issue"></textarea>
                    </div>
                    <x-custom-purple-button btnType="submit" text="Report" />
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.report-forum-reason-select').forEach(function(selectElement) {
            selectElement.addEventListener('change', function() {
                var reportForumReasonSelect = this;
                var form = reportForumReasonSelect.closest('form');
                var otherReportForumReasonContainer = form.querySelector(
                    '.other-report-forum-reason-container');
                var otherReasonTextarea = form.querySelector('.other-reason-reporting-forum');

                if (reportForumReasonSelect.value === 'Other') {
                    reportForumReasonSelect.removeAttribute('name');
                    otherReportForumReasonContainer.classList.remove('hidden');
                    otherReasonTextarea.setAttribute('name', 'reason');
                    otherReasonTextarea.setAttribute('required', 'required');
                } else {
                    reportForumReasonSelect.setAttribute('name', 'reason');
                    otherReportForumReasonContainer.classList.add('hidden');
                    otherReasonTextarea.removeAttribute('name');
                    otherReasonTextarea.removeAttribute('required');
                }
            });
        });
    });
</script>
