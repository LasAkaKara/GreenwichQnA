<div class="edit-answer-container">
    <h2>Edit Your Answer</h2>
    <form action="" method="post" class="edit-form">
        <input type="hidden" name="answer_id" value="<?=$answer['answer_id'];?>">
        <input type="hidden" name="post_id" value="<?=$answer['post'];?>">
        
        <div class="form-group">
            <label for="answer_content">Answer Content</label>
            <textarea 
                name="answer_content" 
                id="answer_content"
                class="form-control"
                rows="6"
                placeholder="Enter your answer content"
                required
            ><?=trim($answer['answer_content'])?></textarea>
        </div>

        <div class="form-actions">
            <button type="submit" name="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Changes
            </button>
            <a href="post.php?id=<?=$answer['post']?>" class="btn">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div>