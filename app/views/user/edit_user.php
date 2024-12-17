<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User - User Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Sidebar -->
    <?php include APP_DIR . 'views/templates/adminsidebar.php'; ?>

    <!-- Main content -->
    <div class="main-content" style="margin-left: 250px; padding: 20px;">
        <div class="container">
            <h1 class="mb-4">Edit User</h1>
            <div class="card">
                <div class="card-body">
                    <form action="<?= site_url('auth/user/update/' . $user['id']); ?>" method="POST">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="<?= $user['first_name']; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="middle_name" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?= $user['middle_name']; ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="<?= $user['last_name']; ?>" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="contact" class="form-label">Contact</label>
                                <input type="text" class="form-control" id="contact" name="contact" value="<?= $user['contact']; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="male" <?= $user['gender'] == 'male' ? 'selected' : ''; ?>>Male</option>
                                    <option value="female" <?= $user['gender'] == 'female' ? 'selected' : ''; ?>>Female</option>
                                    <option value="other" <?= $user['gender'] == 'other' ? 'selected' : ''; ?>>Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required><?= $user['address']; ?></textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="<?= site_url('auth/user/manage'); ?>" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
