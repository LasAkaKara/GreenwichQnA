<div class="feed-container">
    <div class="feed-header">
        <h2>All Questions</h2>
        <a href="addpost.php" class="btn btn-primary">Ask a Question</a>
    </div>

    <div class="feed-filters">
        <a href="feed.php?filter=newest" class="btn <?= ($filter === 'newest' || !isset($filter)) ? 'active' : '' ?>"> Newest </a>
        <a href="feed.php?filter=most_answered" class="btn <?= ($filter === 'most_answered') ? 'active' : '' ?>"> Most Answered </a>
        <a href="feed.php?filter=unanswered" class="btn <?= ($filter === 'unanswered') ? 'active' : '' ?>"> Unanswered </a>
    </div>

    <?php foreach($posts as $post):?>
        <div class="post-card">
            <a class="post" href="post.php?id=<?=$post['post_id']?>"> 
                <div class="post-header">
                    <h3><?=htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8')?></h3>
                    <span class="module-badge">
                        <i class="fas fa-bookmark"></i>
                        <?=htmlspecialchars($post['module'], ENT_QUOTES, 'UTF-8')?>
                    </span>
                </div>
                
                <div class="post-meta">
                    <div class="post-author">
                        <i class="fas fa-user-circle"></i>
                        <span><?=htmlspecialchars($post['authorname'], ENT_QUOTES, 'UTF-8')?></span>
                    </div>
                    <div class="post-stats">
                        <div class="stat-item">
                            <i class="fas fa-thumbs-up"></i>
                            <span><?=htmlspecialchars($post['like_count'], ENT_QUOTES, 'UTF-8')?> likes</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-thumbs-down"></i>
                            <span><?=htmlspecialchars($post['dislike_count'], ENT_QUOTES, 'UTF-8')?> dislikes</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-comments"></i>
                            <span><?=htmlspecialchars($post['answers_count'], ENT_QUOTES, 'UTF-8')?> answers</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach;?>
</div>