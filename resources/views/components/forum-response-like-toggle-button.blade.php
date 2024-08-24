<div class="flex items-center text-xs font-semibold text-custom-red">
    <!-- Render like icon -->
    <button id="likeResponseButton" onclick="toggleResponseLike({{ $forumResponse->forum_response_id }})">
        @if ($forumResponse->isLikedBy(auth()->user()))
            <span id="likeResponIcon{{ $forumResponse->forum_response_id }}"
                class="material-icons-outlined me-2">favorite</span>
        @else
            <span id="likeResponIcon{{ $forumResponse->forum_response_id }}"
                class="material-symbols-outlined me-2">favorite</span>
        @endif
    </button>
    <!-- Display like count -->
    <p class="likeResponseCount{{ $forumResponse->forum_response_id }}">
        {{ $forumResponse->forum_response_likes_count }}
    </p>
    &nbsp; Likes
</div>
<script>
    async function toggleResponseLike(forumResponseId) {
        // console.log(forumResponseId);
        try {
            // Send a POST request to the toggle like route
            const response = await fetch(`/forum-responses/${forumResponseId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add CSRF token
                },
                body: JSON.stringify({}),
            });

            // Check request like 
            if (response.status === 200) {
                // Get the like icon element
                var likeResponIcon = document.getElementById(`likeResponIcon${forumResponseId}`);

                // Toggle the appearance of the like icon
                if (likeResponIcon.classList.contains('material-icons-outlined')) {
                    // change to not liked
                    likeResponIcon.classList.remove('material-icons-outlined');
                    likeResponIcon.classList.add('material-symbols-outlined');

                    // Decrease the like count by 1
                    var likeResponseCountElements = document.getElementsByClassName(
                        `likeResponseCount${forumResponseId}`);
                    Array.from(likeResponseCountElements).forEach(function(likeResponseCountElement) {
                        likeResponseCountElement.textContent = parseInt(likeResponseCountElement
                            .textContent) - 1;
                    });
                } else {
                    // change to liked
                    likeResponIcon.classList.remove('material-symbols-outlined');
                    likeResponIcon.classList.add('material-icons-outlined');

                    // Increase the like count by 1
                    var likeResponseCountElements = document.getElementsByClassName(
                        `likeResponseCount${forumResponseId}`);
                    Array.from(likeResponseCountElements).forEach(function(likeResponseCountElement) {
                        likeResponseCountElement.textContent = parseInt(likeResponseCountElement
                            .textContent) + 1;
                    });
                }

                // Update like count (optional)
                // You can update the like count if needed
            } else if (response.status === 401) {
                // Handle unauthorized (redirect) response
                console.error('You need to log in to like forums response');
            } else {
                console.error('Failed to toggle like');
            }
        } catch (error) {
            console.error('Error toggling like:', error);
        }
    }
</script>
