function handleLike(postId, action) {
    // Fetch the like.php file
    fetch('actions/like.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `post_id=${postId}&action=${action}` // Send the post_id and action to the like.php file
    })
    // Parse the response as JSON
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update like/dislike counts
            document.querySelector(`#post-${postId} .like-count`).textContent = data.likes;
            document.querySelector(`#post-${postId} .dislike-count`).textContent = data.dislikes;
            
            // Toggle active states
            const likeBtn = document.querySelector(`#post-${postId} .like-btn`);
            const dislikeBtn = document.querySelector(`#post-${postId} .dislike-btn`);
            
            if (action === 'like') {
                likeBtn.classList.toggle('active');
                dislikeBtn.classList.remove('active');
            } else {
                dislikeBtn.classList.toggle('active');
                likeBtn.classList.remove('active');
            }
        }
    })
    .catch(error => console.error('Error:', error)); // Catch any errors
} 