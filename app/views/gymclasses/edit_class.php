<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Class - Gym Management System</title>
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
        .form-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <?php include APP_DIR.'views/templates/adminsidebar.php'; ?>

    <!-- Main content -->
    <div class="main-content">
        <div class="container">
            <h1>Edit Class</h1>
            <div class="form-container">
                <form action="<?= site_url('auth/class/update/' . $class['id']); ?>" method="POST">
                    <label for="type">Class Type:</label>
                    <input type="text" name="type" class="form-control mb-3" value="<?= $class['type']; ?>" required>
                    <label for="description">Description:</label>
                    <textarea name="description" class="form-control mb-3"><?= $class['description']; ?></textarea>
                    <label for="duration_minutes">Duration (in minutes):</label>
                    <input type="number" name="duration_minutes" class="form-control mb-3" value="<?= $class['duration_minutes']; ?>" required>
                    <label for="price">Price:</label>
                    <input type="number" step="0.01" name="price" class="form-control mb-3" value="<?= $class['price']; ?>" required>
                    <label for="instructor">Gym Instructor:</label>
                    <input type="text" name="instructor" class="form-control mb-3" value="<?= $class['instructor']; ?>" required>
                    <label for="schedule">Schedule:</label>
                    <input type="datetime-local" name="schedule" class="form-control mb-4" value="<?= $class['schedule']; ?>" required>
                    <button type="submit" class="btn btn-success">Update Class</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
