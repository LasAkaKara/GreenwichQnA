<div class="profile-container">
    <div class="profile-header">
        <h2>Edit Profile</h2>
    </div>

    <form action="" method="post" enctype="multipart/form-data" class="edit-form">
        <div class="form-group">
            <label for="avatar">Profile Picture</label>
            <input type="file" name="avatar" id="avatar" class="form-control" accept="image/*">
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" 
                   value="<?= htmlspecialchars($user['username']) ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" 
                   value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>

        <div class="form-group">
            <label for="new_password">New Password (leave blank to keep current)</label>
            <input type="password" name="new_password" id="new_password" class="form-control">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Changes
            </button>
            <a href="profile.php" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div> 