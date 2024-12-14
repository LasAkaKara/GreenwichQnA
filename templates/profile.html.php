<div class="post-container">
    <div class="post-header" style="padding: 10px; display: flex; justify-content: space-between; align-items: center;">
        <h2>My Profile</h2>
        <div class="post-actions">
            <a href="editprofile.php" class="btn">
                <i class="fas fa-edit"></i> Edit Profile
            </a>
            <button onclick="confirmDelete()" class="btn btn-delete">
                <i class="fas fa-trash"></i> Delete Account
            </button>
        </div>
    </div>

    <div class="post-content">
        <div class="profile-avatar">
            <img src="<?= htmlspecialchars($user['profile_picture']) ?>" 
                 alt="Profile Picture">
            <h3><?= htmlspecialchars($user['username']) ?></h3>
        </div>

        <div class="profile-details">
            <div class="detail-group">
                <label>Username</label>
                <p><?= htmlspecialchars($user['username']) ?></p>
            </div>
            <div class="detail-group">
                <label>Email</label>
                <p><?= htmlspecialchars($user['email']) ?></p>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete() {
    if (confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
        window.location.href = 'actions/delete_account.php';
    }
}
</script> 