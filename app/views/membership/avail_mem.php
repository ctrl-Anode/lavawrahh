<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Membership Plans</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
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
        .card {
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .badge-corner {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
<body>
    <!-- Sidebar -->
    <?php include APP_DIR.'views/templates/usersidebar.php'; ?>

    <!-- Main content -->
    <div class="main-content">
        <div class="container">
            <h1 class="mb-4">Membership Plans</h1>
            <div class="card-container">
                <?php foreach ($memberships as $membership): ?>
                    <?php if($membership['status'] === 'active'): ?>
                        <form action="<?=site_url('user/memberships/avail')?>" method="POST">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <span class="badge bg-success badge-corner">Active</span>
                                    <h5 class="card-title"><?= html_escape($membership['type']); ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted">₱ <?= number_format($membership['price'], 2); ?></h6>
                                    <p class="card-text"><?= html_escape($membership['info']); ?></p>
                                    <p class="text-muted">Duration: <?= $membership['duration_months']; ?> months</p>
                                    <input type="hidden" name="membership_id" value="<?= $membership['id']; ?>">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-check-circle me-1"></i> Avail Now
                                    </button>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
