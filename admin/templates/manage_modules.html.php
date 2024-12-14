<div class="container">
    <div class="header-actions">
        <h2>Manage Modules</h2>
        <a href="addmodule.php" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Module
        </a>
    </div>

    <div class="modules-list">
        <table class="table">
            <thead>
                <tr>
                    <th>Module ID</th>
                    <th>Module Name</th>
                    <th>Lecturer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($modules as $module): ?>
                    <tr>
                        <td><?= htmlspecialchars($module['module_id']) ?></td>
                        <td><?= htmlspecialchars($module['module_name']) ?></td>
                        <td><?= htmlspecialchars($module['lecturer']) ?></td>
                        <td class="actions">
                            <a href="editmodule.php?id=<?= $module['module_id'] ?>" class="btn">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="actions/deletemodule.php" method="POST" style="display: inline;" 
                                  onsubmit="return confirm('Are you sure you want to delete this module?');">
                                <input type="hidden" name="module_id" value="<?= $module['module_id'] ?>">
                                <button type="submit" class="btn btn-delete">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
