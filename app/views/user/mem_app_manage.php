<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Membership Applications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #343a40;
            --secondary-color: #495057;
            --text-color: #f8f9fa;
            --hover-color: #6c757d;
            --transition-speed: 0.3s;
        }

        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            background-color: var(--primary-color);
            height: 100vh;
            padding-top: 20px;
            position: fixed;
            width: 250px;
            color: var(--text-color);
            transition: transform var(--transition-speed);
            z-index: 1000;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 16px;
            color: var(--text-color);
            transition: background var(--transition-speed);
        }

        .sidebar a:hover {
            background-color: var(--secondary-color);
        }

        .sidebar a .icon {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left var(--transition-speed);
        }

        .card {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content.active {
                margin-left: 250px;
            }
        }

        /* Utility classes */
        .mb-4 { margin-bottom: 1rem; }
    </style>
    
    <?php include APP_DIR.'views/templates/adminsidebarstyle.php'; ?>
</head>
<body>
    <!-- Sidebar -->
    <?php include APP_DIR . 'views/templates/adminsidebar.php'; ?>

    <!-- Main content -->
    <div class="main-content">
        <div class="container">
            <h1 class="mb-4">Membership Applications</h1>
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Info</th>
                                <th>Duration</th>
                                <th>Start Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($applications as $app): ?>
                                <tr>
                                    <td><?= $app['id']; ?></td>
                                    <td><?= $app['username']; ?></td>
                                    <td><?= $app['type']; ?></td>
                                    <td>₱ <?= number_format($app['price'], 2); ?></td>
                                    <td><?= $app['info']; ?></td>
                                    <td><?= $app['duration_months']; ?> months</td>
                                    <td><?= date('F j, Y', strtotime($app['start_date'])); ?></td>
                                    <td><?= $app['status']; ?></td>
                                    <td>
                                        <a href="<?= site_url('user/memberships/approve/' . $app['id']); ?>" class="btn btn-sm btn-success">
                                            <i class="fas fa-check-circle me-1"></i>Approve
                                        </a>
                                        <a href="<?= site_url('user/memberships/reject/' . $app['id']); ?>" class="btn btn-sm btn-danger">
                                            <i class="fas fa-times-circle me-1"></i>Reject
                                        </a>
                                        <a href="<?= site_url('auth/user/applications/delete/' . $app['id']); ?>" class="btn btn-sm btn-danger">
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
