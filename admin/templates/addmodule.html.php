<div class="add-container">
    <h2>Add New Module</h2>
    <form action="" method="post" class="post-form">
        <div class="form-group">
            <label for="module_id">Module ID</label>
            <input 
                type="text" 
                name="module_id" 
                id="module_id" 
                class="form-control"
                placeholder="e.g., COMP1841"
                pattern="[A-Za-z0-9]+"
                required
            >
        </div>

        <div class="form-group">
            <label for="module_name">Module Name</label>
            <input 
                type="text" 
                name="module_name" 
                id="module_name"
                class="form-control"
                placeholder="Enter module name"
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
                placeholder="Enter lecturer name"
                required
            >
        </div>

        <div class="form-actions">
            <button type="submit" name="submit" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Module
            </button>
            <a href="manage_modules.php" class="btn">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div>