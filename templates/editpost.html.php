<div class="edit-post-container">
    <h2>Edit Your Post</h2>
    <form action="" method="post" class="edit-form" enctype="multipart/form-data">
        <input type="hidden" name="post_id" value="<?=$posts['post_id'];?>">
        
        <div class="form-group">
            <label for="title">Post Title</label>
            <textarea 
                name="title" 
                id="title"
                class="form-control"
                rows="3"
                placeholder="Enter your post title"
            ><?=trim($posts['title'])?></textarea>
        </div>

        <div class="form-group">
            <label for="post_content">Post Content</label>
            <textarea 
                name="post_content" 
                id="post_content"
                class="form-control"
                rows="6"
                placeholder="Enter your post content"
            ><?=trim($posts['post_content'])?></textarea>
        </div>

        <div class="form-group">
            <label for="image_path">Update Image</label>
            <input type="file" 
                name="image_path" 
                id="image_path" 
                class="form-control" 
                accept="image/*"
            >
        </div>

        <div class="form-actions">
            <button type="submit" name="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Changes
            </button>
            <a href="feed.php" class="btn">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div>