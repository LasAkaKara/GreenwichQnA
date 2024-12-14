<div class="post-container">
    <!-- Main Post -->
    <article class="post-content">
        <div class="post-header">
            <h1><?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?></h1>
            <div class="post-meta">
                <span class="author">
                    <i class="fas fa-user-circle"></i>
                    <?= htmlspecialchars($post['author_name'], ENT_QUOTES, 'UTF-8') ?>
                </span>
                <span class="date">
                    <i class="fas fa-clock"></i>
                    <?= date('M j, Y g:i a', strtotime($post['time'])) ?>
                </span>
            </div>
        </div>
        
        <div class="post-body">
            <?= nl2br(htmlspecialchars($post['post_content'], ENT_QUOTES, 'UTF-8')) ?>
            <?php if (!empty($post['image_path'])): ?>
                <div class="post-image">
                    <img src="<?= htmlspecialchars($post['image_path']) ?>" 
                        alt="Post image"
                        class="img-fluid">
                </div>
            <?php endif; ?>
        </div>
        <div>
            <div class="post-actions" id="post-<?=$post['post_id']?>">
                <button 
                    class="like-btn <?= isset($post['user_like']) && $post['user_like'] === 1 ? 'active' : '' ?>"
                    onclick="handleLike(<?=$post['post_id']?>, 'like')"
                >
                    <i class="fas fa-thumbs-up"></i>
                    <span class="like-count"><?=$post['like_count']?></span>
                </button>
                <button 
                    class="dislike-btn <?= isset($post['user_like']) && $post['user_like'] === 0 ? 'active' : '' ?>"
                    onclick="handleLike(<?=$post['post_id']?>, 'dislike')"
                >
                    <i class="fas fa-thumbs-down"></i>
                    <span class="dislike-count"><?=$post['dislike_count']?></span>
                </button>
            </div>
            <?php if($post['author'] == $_SESSION['user_id']): ?>
                <div class="post-actions">
                    <a href="editpost.php?id=<?= $post['post_id'] ?>" class="btn btn-edit">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="actions/deletepost.php" method="POST" style="display: inline;" 
                onsubmit="return confirm('Are you sure you want to delete this post?');">
                        <input type="hidden" name="post_id" value="<?=$post['post_id']?>">
                        <button type="submit" class="btn btn-delete">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </article>

    <!-- Answers Section -->
    <section class="answers-section">
        <h2><?= count($answers) ?> Answers</h2>
        
        <!-- Answer Form -->
            <form action="actions/addanswer.php" method="post" class="answer-form">
                <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">
                <textarea name="answer_content" placeholder="Write an answer..." required></textarea>
                <button type="submit" class="btn btn-primary">Submit Answer</button>
            </form>

        <!-- List of Answers -->
        <?php foreach ($answers as $answer): ?>
            <article class="answer">
                <div class="answer-content">
                    <div class="answer-meta">
                        <span class="author">
                            <i class="fas fa-user-circle"></i>
                            <?= htmlspecialchars($answer['author_name'], ENT_QUOTES, 'UTF-8') ?>
                        </span>
                        <span class="date">
                            <i class="fas fa-clock"></i>
                            <?= date('M j, Y g:i a', strtotime($answer['time'])) ?>
                        </span>
                    </div>
                    <div class="answer-body">
                        <?= nl2br(htmlspecialchars($answer['answer_content'], ENT_QUOTES, 'UTF-8')) ?>
                    </div>
                    <?php if($answer['author'] == $_SESSION['user_id']): ?>
                        <div class="post-actions">
                            <a href="editanswer.php?id=<?=$answer['answer_id']?>" class="btn btn-edit">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="actions/deleteanswer.php" method="POST" style="display: inline;" 
                        onsubmit="return confirm('Are you sure you want to delete this answer?');">
                                <input type="hidden" name="post_id" value="<?=$post['post_id']?>">
                                <input type="hidden" name="answer_id" value="<?=$answer['answer_id']?>">
                                <button type="submit" class="btn btn-delete">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Comments for this answer -->
                <div class="comments-section">
                    <?php if (isset($comments_by_answer[$answer['answer_id']])): ?>
                        <?php foreach ($comments_by_answer[$answer['answer_id']] as $comment): ?>
                            <div class="comment">
                                <div class="comment-content">
                                    <span class="author"><?= htmlspecialchars($comment['author_name'], ENT_QUOTES, 'UTF-8') ?>:</span>
                                    <?= htmlspecialchars($comment['comment_content'], ENT_QUOTES, 'UTF-8') ?>
                                </div>
                                <div class="comment-meta">
                                    <span class="date"><?= date('M j, Y g:i a', strtotime($comment['time'])) ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <!-- Comment Form -->
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <form action="actions/addcomment.php" method="post" class="comment-form">
                            <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">
                            <input type="hidden" name="answer_id" value="<?= $answer['answer_id'] ?>">
                            <input type="text" name="comment_content" placeholder="Add a comment..." required>
                            <button type="submit" class="btn btn-small">Comment</button>
                        </form>
                    <?php endif; ?>
                </div>
            </article>
        <?php endforeach; ?>
    </section>
</div>