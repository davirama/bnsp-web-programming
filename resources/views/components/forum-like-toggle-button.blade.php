<div class="flex items-center mb-2 me-2 text-xs font-semibold text-custom-red">
    <!-- Render like icon -->
    <button onclick="toggleLike({{ $forum->forum_id }})">
        @if ($forum->isLikedBy(auth()->user()))
            <span id="likeIcon{{ $forum->forum_id }}" class="material-icons-outlined me-2">favorite</span>
        @else
            <span id="likeIcon{{ $forum->forum_id }}" class="material-symbols-outlined me-2">favorite</span>
        @endif
    </button>
    <!-- Display like count -->
    <p class="likeCount{{ $forum->forum_id }}">
        {{ $forum->forum_likes_count }}
    </p>
    &nbsp; Likes
</div>
<script>
    async function toggleLike(forumId) {
        try {
            // Send a POST request to the toggle like route
            const response = await fetch(`/forums/${forumId}/like`, {
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
                var likeIcon = document.getElementById(`likeIcon${forumId}`);

                // Toggle the appearance of the like icon
                if (likeIcon.classList.contains('material-icons-outlined')) {
                    // change to not liked
                    likeIcon.classList.remove('material-icons-outlined');
                    likeIcon.classList.add('material-symbols-outlined');

                    // Decrease the like count by 1
                    var likeCountElements = document.getElementsByClassName(`likeCount${forumId}`);
                    Array.from(likeCountElements).forEach(function(likeCountElement) {
                        likeCountElement.textContent = parseInt(likeCountElement.textContent) - 1;
                    });
                } else {
                    // change to liked
                    likeIcon.classList.remove('material-symbols-outlined');
                    likeIcon.classList.add('material-icons-outlined');

                    // Increase the like count by 1
                    var likeCountElements = document.getElementsByClassName(`likeCount${forumId}`);
                    Array.from(likeCountElements).forEach(function(likeCountElement) {
                        likeCountElement.textContent = parseInt(likeCountElement.textContent) + 1;
                    });
                }

                // Update like count (optional)
                // You can update the like count if needed
            } else if (response.status === 401) {
                // Handle unauthorized (redirect) response
                console.error('You need to log in to like forums');
            } else {
                console.error('Failed to toggle like');
            }
        } catch (error) {
            console.error('Error toggling like:', error);
        }
    }
</script>
