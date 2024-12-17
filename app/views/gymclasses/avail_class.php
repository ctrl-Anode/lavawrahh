<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Classes - Gym Management System</title>
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
        .main-content {
            margin-left: 250px;
            padding: 20px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <?php include APP_DIR.'views/templates/usersidebar.php'; ?>

    <!-- Main content -->
    <div class="main-content">
        <div class="container">
            <h1 class="mb-4">Classes</h1>
            <div class="card-container">
                <?php foreach ($classes as $class): ?>
                    <form action="<?= site_url('user/class/avail') ?>" method="POST">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($class['type']); ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted">Price: ₱<?= number_format($class['price'], 2); ?></h6>
                                <p class="card-text">
                                    <strong>Description:</strong> <?= htmlspecialchars($class['description']); ?><br>
                                    <strong>Duration:</strong> <?= htmlspecialchars($class['duration_minutes']); ?> minutes<br>
                                    <strong>Instructor:</strong> <?= htmlspecialchars($class['instructor']); ?><br>
                                    <strong>Schedule:</strong> <?= date('F j, Y g:i A', strtotime($class['schedule'])); ?>
                                </p>
                                <input type="hidden" name="id" value="<?= htmlspecialchars($class['id']); ?>">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-check-circle"></i> Book Now
                                </button>
                            </div>
                        </div>
                    </form>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
