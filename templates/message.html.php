<div class="add-container">
    <h2>Contact An Admin</h2>
    <form action="" method="post" class="post-form">
        <div class="form-group">
            <label for="title">Subject</label>
            <input 
                type="text" 
                name="title" 
                id="title" 
                class="form-control"
                placeholder="Enter the subject of your message"
                required
            >
        </div>

        <div class="form-group">
            <label for="message_content">Message</label>
            <textarea 
                name="message_content" 
                id="message_content"
                class="form-control"
                rows="8"
                placeholder="What would you like to tell the admin?"
                required
            ></textarea>
        </div>

        <div class="form-actions">
            <button type="submit" name="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane"></i> Send Message
            </button>
            <a href="feed.php" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div> 