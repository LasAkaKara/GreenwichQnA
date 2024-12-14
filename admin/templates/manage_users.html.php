<div class="container">
    <h2>Manage Users</h2>
    <div class="users-list">
        <table class="table">
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <?php if ($user['user_id'] != $_SESSION['user_id']): ?>
                        <tr>
                            <td>
                                <div>
                                    <i class="fas fa-user-circle fa-2x"></i>
                                </div>
                            </td>
                            <td><?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= $user['isAdmin'] ? 'Admin' : 'User' ?></td>
                            <td class="actions">
                                <?php if (!$user['isAdmin']): ?>
                                    <form action="actions/makeadmin.php" method="POST" style="display: inline;" 
                                          onsubmit="return confirm('Make this user an admin?');">
                                        <input type="hidden" name="user_id" value="<?=$user['user_id']?>">
                                        <button type="submit" class="btn">
                                            <i class="fas fa-user-shield"></i> Make Admin
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <form action="actions/removeadmin.php" method="POST" style="display: inline;" 
                                        onsubmit="return confirm('Remove admin privileges from this user?');">
                                        <input type="hidden" name="user_id" value="<?=$user['user_id']?>">
                                        <button type="submit" class="btn">
                                            <i class="fas fa-user-minus"></i> Remove Admin
                                        </button>
                                    </form>
                                <?php endif; ?>
                                <form action="actions/deleteuser.php" method="POST" style="display: inline;" 
                                      onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                                    <input type="hidden" name="user_id" value="<?=$user['user_id']?>">
                                    <button type="submit" class="btn btn-delete">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

