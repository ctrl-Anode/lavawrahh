<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Memberships - Gym Management System</title>
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
        .table-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #f4f4f4;
        }
        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        a.btn-action {
            margin-right: 10px;
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
            <h1 class="mb-4">Memberships</h1>
            <a href="<?= site_url('auth/memberships/apply'); ?>" class="btn btn-primary btn-add">
                <i class="fas fa-plus-circle me-2"></i>Add New Membership
            </a>
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Info</th>
                                <th>Duration (Months)</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($memberships as $membership): ?>
                                <tr>
                                    <td><?= $membership['id']; ?></td>
                                    <td><?= $membership['type']; ?></td>
                                    <td>₱ <?= number_format($membership['price'], 2); ?></td>
                                    <td><?= $membership['info']; ?></td>
                                    <td><?= $membership['duration_months']; ?></td>
                                    <td><?= $membership['status']; ?></td>
                                    <td class="action-links">
                                        <a href="<?= site_url('auth/memberships/update/' . $membership['id']); ?>" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </a>
                                        <a href="<?= site_url('auth/memberships/delete/' . $membership['id']); ?>" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt me-1"></i>Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
