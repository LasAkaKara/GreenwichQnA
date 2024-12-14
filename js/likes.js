function handleLike(postId, action) {
    // Send like/dislike request to server
    fetch('actions/like.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `post_id=${postId}&action=${action}`
    })
    .then(response => response.json()) // Parse response as JSON
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
    .catch(error => console.error('Error:', error));
} 