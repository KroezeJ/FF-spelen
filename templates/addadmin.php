<form method="post">
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
        <label for="email" class="form-label">Email</label>
        <input name="email" id="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="text" name="password" id="password" class="form-control" required>
    </div>
    <?php submitButton("Send") ?>
</form>