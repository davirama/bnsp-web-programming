<!-- Modal Main -->
<div id="main-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Jawaban Kamu Benar!!!! Silahkan Bermain dengan Avatar (+50Exp)
                </h3>

            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <div class="flex justify-center">
                    <img id="current_image"
                        src="{{ asset('storage/gif_bath_rank_gamifikasi/' . $user->rankGamifikasi->gif_bath_rank_gamifikasi) }}"
                        alt="Preview Image" class="w-48 md:w-64">
                </div>
            </div>

            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <form action="{{ route('dashboard.pelanggan.interaksi-avatar.playWithAvatar') }}" method="POST">
                    {{-- <input type="hidden" value="{{ $user->rank_account_user_id }}"> --}}
                    @csrf
                    <button type="submit" type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Selanjutnya</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="quiz-essay-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-lg max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Quiz Essay
                </h3>

            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5" id="quiz-essay-content">
                <!-- Dynamic quiz content will be loaded here -->
            </div>
        </div>
    </div>
</div>

{{-- button for triggering main-modal, because if we just remove hidden in main-modal, it didnt center. we should trigger data-modal-toogle dan data-modal-target, remember!!! this is flowbite components. --}}
<button id="play-button" class="relative" data-modal-target="main-modal" data-modal-toggle="main-modal" hidden>

</button>



<script>
    function fetchQuizEssay() {
        fetch('{{ route('gamifikasi.get-quiz-essay') }}')
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    document.getElementById('quiz-essay-content').innerHTML = '<p>No quiz found.</p>';
                } else {
                    const quiz = data.quiz;
                    const quizHtml = `
                    <h1 class="text-2xl font-bold mb-4">${quiz.pertanyaan_quiz2}</h1>
                    <div class="flex justify-center items-center">
                        
                        ${quiz.gambar_quiz2 ? `<img src="{{ asset('storage/gambar-quiz2/') }}/${quiz.gambar_quiz2}" alt="Quiz Image" class="mb-4 max-h-80">` : ''}
                    </div>
                    <form id="quizEssayForm" method="POST">
                        @csrf
                        <textarea name="answer" rows="4" class="w-full p-2 border rounded hover:ring-custom-purple" required></textarea>
                        <div class="flex justify-center">
                        <button type="submit"
                            class="flex justify-center items-center border border-custom-purple text-custom-midnight font-bold text-center w-full whitespace-nowrap py-2 px-5 mt-5 rounded-md mb-10 relative overflow-hidden hover:text-white ease-linear duration-500">
                            <div class="z-10 text-xl">
                                Submit Jawaban
                            </div>
                            <span class="custom-ease-in absolute bg-custom-purple top-0 left-0 w-0 h-full"></span>
                        </button>
                    </div>
                    </form>
                `;

                    document.getElementById('quiz-essay-content').innerHTML = quizHtml;

                    // Add event listener to the form
                    document.getElementById('quizEssayForm').addEventListener('submit', function(event) {
                        event.preventDefault();

                        let formData = new FormData(this);

                        fetch(`{{ url('/gamifikasi/quiz-essay/submit') }}/${quiz.quiz2_id}`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Close the quiz modal
                                    document.getElementById('quiz-essay-modal').classList.add('hidden');
                                    // Open the play modal
                                    document.getElementById('play-button').click();
                                } else {
                                    location.reload();
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                    });
                }
            })
            .catch(error => {
                console.error('Error fetching quiz:', error);
                document.getElementById('quiz-essay-content').innerHTML = '<p>Error fetching quiz.</p>';
            });
    }

    // Fetch quiz when the modal is opened
    document.querySelector('[data-modal-toggle="quiz-essay-modal"]').addEventListener('click', fetchQuizEssay);
</script>
