<form method="post" enctype="multipart/form-data">
    <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['message']; ?>
        </div>
    <?php unset($_SESSION['message']);
    } ?>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="Description" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image URL</label>
        <input type="text" name="image" id="image" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="url" class="form-label">URL (.html file in folder)</label>
        <input type="text" name="url" id="url" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="file" class="form-label">ZIP File to game</label><br>
        <input type="file" name="zipFile">
    </div>
    <div class="mb-3">
        <label for="category" name="category" class="form-label">Category</label>
        <select name="category" class="form-select">
            <option value="Action">Action</option>
            <option value="Adventure">Adventure</option>
            <option value="Casual">Casual</option>
            <option value="Indie">Indie</option>
            <option value="Multiplayer">Multiplayer</option>
            <option value="Racing">Racing</option>
            <option value="RPG">RPG</option>
            <option value="Simulation">Simulation</option>
            <option value="Sports">Sports</option>
            <option value="Strategy">Strategy</option>
        </select>
    </div>
    <?php submitButton("Send") ?>
</form>