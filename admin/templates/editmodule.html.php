<div class="add-container">
    <h2>Edit Module</h2>
    <form action="" method="post" class="post-form">
        <input type="hidden" name="module_id" value="<?=$module['module_id'];?>">
        
        <div class="form-group">
            <label for="module_id">Module ID</label>
            <input 
                type="text" 
                value="<?=htmlspecialchars($module['module_id'])?>"
                class="form-control"
                disabled
            >
            <small class="form-text text-muted">Module ID cannot be changed</small>
        </div>

        <div class="form-group">
            <label for="module_name">Module Name</label>
            <input 
                type="text" 
                name="module_name" 
                id="module_name"
                class="form-control"
                value="<?=htmlspecialchars($module['module_name'])?>"
                required
            >
        </div>

        <div class="form-group">
            <label for="lecturer">Lecturer</label>
            <input 
                type="text" 
                name="lecturer" 
                id="lecturer"
                class="form-control"
                value="<?=htmlspecialchars($module['lecturer'])?>"
                required
            >
        </div>

        <div class="form-actions">
            <button type="submit" name="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Changes
            </button>
            <a href="manage_modules.php" class="btn">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div>
