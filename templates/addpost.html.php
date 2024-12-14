<div class="add-container">
    <h2>Ask a Question</h2>
    <form action="" method="post" class="post-form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Question Title</label>
            <input 
                type="text" 
                name="title" 
                id="title" 
                class="form-control"
                placeholder="What's your question? Be specific."
                required
            >
        </div>

        <div class="form-group">
            <label for="post_content">Question Details</label>
            <textarea 
                name="post_content" 
                id="post_content"
                class="form-control"
                rows="8"
                placeholder="Provide all the details someone would need to answer your question..."
                required
            ></textarea>
        </div>

        <div class="form-group">
            <label for="post_image">Add Image (Optional)</label>
            <input 
                type="file" 
                name="image_path" 
                id="image_path" 
                class="form-control"
                accept="image/*"
            >
            <small class="form-text text-muted">
                Supported formats: JPG, PNG, GIF (Max size: 5MB)
            </small>
        </div>

        <div class="form-group">
            <label for="module">Module</label>
            <select name="module" id="module" class="form-control" required>
                <option value="">Select a module</option>
                <?php foreach ($modules as $module): ?>
                    <option value="<?= htmlspecialchars($module['module_id']) ?>">
                        <?= htmlspecialchars($module['module_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" name="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane"></i> Post Question
            </button>
            <a href="feed.php" class="btn">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div> 