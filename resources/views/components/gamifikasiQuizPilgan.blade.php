<!-- Modal Mandi -->
<div id="mandi-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Jawaban Kamu Benar!!!! Silahkan Mandikan Avatar (+50Exp)
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
                <form action="{{ route('dashboard.pelanggan.interaksi-avatar.bathAvatar') }}" method="POST">
                    {{-- <input type="hidden" value="{{ $user->rank_account_user_id }}"> --}}
                    @csrf
                    <button type="submit" type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Selanjutnya</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Quiz Pilgan modal -->
<div id="quiz-pilgan-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 mt-6 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Quiz
                </h3>

            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5" id="quiz-content">
                <!-- Quiz content will be loaded here -->
            </div>
        </div>
    </div>
</div>

{{-- button for triggering mandi-modal, because if we just remove hidden in mandi-modal, it didnt center. we should trigger data-modal-toogle dan data-modal-target, remember!!! this is flowbite components. --}}
<button id="mandi-button" class="relative" data-modal-target="mandi-modal" data-modal-toggle="mandi-modal" hidden>

</button>

{{-- Script to fetch and display the quiz --}}
<script>
    function fetchQuiz() {
        fetch('{{ route('gamifikasi.get-quiz-pilgan') }}')
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    document.getElementById('quiz-content').innerHTML = '<p>No quiz found.</p>';
                } else {
                    const quiz = data.quiz;
                    const answers = data.answers;
                    let answersHtml = '';

                    answers.forEach(answer => {
                        answersHtml += `
                <div class="mb-3">
                    <input type="radio" name="answer" value="${answer}" required>
                    <label>${answer}</label>
                </div>
            `;
                    });

                    const quizHtml = `
            <h2 class="text-xl font-bold mb-4">${quiz.pertanyaan_quiz1}</h2>
            <div class="flex flex-col justify-center items-center">
                ${quiz.gambar_quiz1 ? `<img src="{{ asset('storage/gambar-quiz1/') }}/${quiz.gambar_quiz1}" alt="Quiz Image" class="mb-4 max-h-80">` : ''}
                <form id="quizForm" method="POST">
                    @csrf
                    <div class="grid grid-cols-2 gap-2 gap-x-8">
                        ${answersHtml}
                    </div>
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
            </div>
        `;

                    document.getElementById('quiz-content').innerHTML = quizHtml;

                    // Add event listener to the form
                    document.getElementById('quizForm').addEventListener('submit', function(event) {
                        event.preventDefault();

                        let formData = new FormData(this);

                        fetch(`{{ url('/gamifikasi/quiz-pilgan/submit') }}/${quiz.quiz1_id}`, {
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
                                    document.getElementById('quiz-pilgan-modal').classList.add(
                                        'hidden');
                                    // Open the mandi modal
                                    document.getElementById('mandi-button').click();
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
                document.getElementById('quiz-content').innerHTML = '<p>Error fetching quiz.</p>';
            });
    }

    // Fetch quiz when the modal is opened
    document.querySelector('[data-modal-toggle="quiz-pilgan-modal"]').addEventListener('click', fetchQuiz);
</script>
