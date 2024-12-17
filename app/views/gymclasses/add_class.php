<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add New Class - Gym Management System</title>
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
            <h1 class="mb-4">Add New Class</h1>
            <div class="form-container">
                <form action="<?= site_url('auth/class/add'); ?>" method="POST">
                    <label for="type">Class Type:</label>
                    <input type="text" name="type" class="form-control mb-3" required>
                    <label for="description">Description:</label>
                    <textarea name="description" class="form-control mb-3"></textarea>
                    <label for="duration_minutes">Duration (in minutes):</label>
                    <input type="number" name="duration_minutes" class="form-control mb-3" required>
                    <label for="price">Price:</label>
                    <input type="number" step="0.01" name="price" class="form-control mb-3" required>
                    <label for="instructor">Gym Instructor:</label>
                    <input type="text" name="instructor" class="form-control mb-3" required>
                    <label for="schedule">Schedule:</label>
                    <input type="datetime-local" name="schedule" class="form-control mb-4" required>
                    <button type="submit" class="btn btn-primary">Add Class</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
