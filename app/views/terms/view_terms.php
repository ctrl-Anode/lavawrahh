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
    <?php
    include APP_DIR.'views/templates/adminsidebar.php';
    ?>

    <!-- Main content -->
    <div class="main-content">
        <div class="container">
            <h1 class="mb-4">Terms and Conditions</h1>
            
            <!-- Add/Edit Term Form -->
            <div class="form-container">
                <h2 id="formTitle">Add New Term</h2>
                <form id="termForm" action="<?= site_url('auth/terms/create'); ?>" method="POST">
                    <input type="hidden" id="id" name="id">
                    <div class="mb-3">
                        <label for="text" class="form-label">Term Text:</label>
                        <textarea class="form-control" id="text" name="text" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status:</label>
                        <input type="text" class="form-control" id="status" name="status" required>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i><span id="submitButtonText">Add Term</span>
                    </button>
                    <button type="button" id="cancelEdit" class="btn btn-secondary d-none">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                </form>
            </div>

            <!-- Terms Table -->
            <div class="table-container">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Term Text</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="termsTableBody">
                        <?php foreach ($terms as $term): ?>
                            <tr>
                                <td><?= $term['id']; ?></td>
                                <td><?= $term['text']; ?></td>
                                <td><?= $term['status']; ?></td>
                                <td>
                                    <a href="<?=site_url('auth/terms/update/' . $term['id']);?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="<?=site_url('auth/terms/delete/' . $term['id']);?>" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Script Links -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add/Edit Term Form Submission
            $('#termForm').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                var url = $(this).attr('action');
                
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + error);
                    }
                });
            });

            function resetForm() {
                $('#formTitle').text('Add New Term');
                $('#termForm')[0].reset();
                $('#id').val('');
                $('#submitButtonText').text('Add Term');
                $('#termForm').attr('action', '<?= site_url("auth/terms/create"); ?>');
                $('#cancelEdit').addClass('d-none');
            }
        });
    </script>
</body>
</html>
