<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add New Membership - Gym Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Roboto', Arial, sans-serif;
        }
        .sidebar {
            background-color: #343a40;
            height: 100vh;
            padding-top: 20px;
            position: fixed;
            width: 250px;
            color: #fff;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 16px;
            color: #fff;
            transition: background 0.3s;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .sidebar a .icon {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .form-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
    
    <?php include APP_DIR.'views/templates/adminsidebarstyle.php'; ?>
</head>
<body>
    <!-- Sidebar -->
    <?php include APP_DIR.'views/templates/adminsidebar.php'; ?>

    <!-- Main content -->
    <div class="main-content">
        <div class="container">
            <h1 class="mb-4">Add New Membership</h1>
            <div class="form-container">
                <form action="<?= site_url('auth/memberships/apply'); ?>" method="POST">
                    <div class="mb-3">
                        <label for="type" class="form-label">Membership Type:</label>
                        <input type="text" class="form-control" id="type" name="type" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Membership Price:</label>
                        <div class="input-group">
                            <span class="input-group-text">₱</span>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="info" class="form-label">Membership Info:</label>
                        <textarea class="form-control" id="info" name="info" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="duration_months" class="form-label">Duration (in months):</label>
                        <input type="number" class="form-control" id="duration_months" name="duration_months" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status:</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="active" selected>Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-2"></i>Add Membership
                    </button>
                    <a href="<?= site_url('auth/memberships/view'); ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back
                    </a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
