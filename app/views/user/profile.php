<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Profile</title>
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
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <?php include APP_DIR . 'views/templates/usersidebar.php'; ?>

    <!-- Main content -->
    <div class="main-content">
        <div class="container">
            <h1 class="mb-4 fas fa-user-alt me-1"> Your Profilee</h1>
            
            <!-- Display Profile Card -->
            <div id="profile-card" class="card">
                <div class="card-body">
                    <form action="<?=site_url('user/user_logout');?>">
                        <h5 class="card-title fas fa-user-alt me-1"> <?= html_escape($user['username']); ?></h5><br><br>
                        <p class="card-text"><strong>Email:</strong> <?= html_escape($user['email']); ?></p>
                        <p class="card-text"><strong>Created:</strong> <?= date('F j, Y', strtotime($user['created_at'])); ?></p>
                        <?php if($user['email_verified_at']): ?>
                            <p class="card-text"><small class="text-success"><i class="fas fa-check-circle"></i> Email verified on <?= date('F j, Y', strtotime($user['email_verified_at'])); ?></small></p>
                        <?php else: ?>
                            <p class="card-text"><small class="text-warning"><i class="fas fa-exclamation-circle"></i> Email not verified</small></p>
                        <?php endif; ?>
                        
                        <!-- Active Membership Information -->
                        <div class="mt-3">
                            <h6 class="mb-2"><i class="fas fa-crown me-2"></i>Active Membership</h6>
                            <?php if(isset($active_membership) && $active_membership): ?>
                                <p class="card-text"><strong>Plan:</strong> <?= html_escape($active_membership['type']); ?></p>
                                <p class="card-text"><strong>Duration:</strong> <?= html_escape($active_membership['duration_months']); ?> months</p>
                                <p class="card-text"><strong>Price:</strong> ₱<?= number_format($active_membership['price'], 2); ?></p>
                                <p class="card-text"><strong>Start Date:</strong> <?= date('F j, Y', strtotime($active_membership['start_date'])); ?></p>
                                <p class="card-text"><small class="text-muted"><?= html_escape($active_membership['info']); ?></small></p>
                                <p class="card-text"><small class="text-muted">Status: <?= html_escape($active_membership['status']); ?></small></p>
                                <?php if($active_membership['terms_accepted']): ?>
                                    <p class="card-text"><small class="text-success"><i class="fas fa-check-circle"></i> Terms & Conditions Accepted</small></p>
                                <?php endif; ?>
                            <?php else: ?>
                                <p class="card-text text-muted">No active membership plan.</p>
                                <a href="<?= site_url('membership/avail'); ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus me-1"></i>Avail Membership
                                </a>
                            <?php endif; ?>
                        </div>

                        <button class="btn btn-sm btn-danger mt-3">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form><br>
                    <button id="update-profile-btn" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit me-1"></i>Update Profile
                    </button>
                </div>
            </div>

            <!-- Update Form (Hidden by Default) -->
            <form id="update-form" class="hidden" action="<?= site_url('user/update_profile'); ?>" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= html_escape($user['username']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= html_escape($user['email']); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <button type="button" id="cancel-update-btn" class="btn btn-secondary">Cancel</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            // Show update form when the button is clicked
            $('#update-profile-btn').click(function () {
                $('#profile-card').hide(); // Hide the profile card
                $('#update-form').removeClass('hidden'); // Show the update form
            });

            // Cancel update and show the profile card
            $('#cancel-update-btn').click(function () {
                $('#update-form').addClass('hidden'); // Hide the update form
                $('#profile-card').show(); // Show the profile card
            });

            // Client-side validation
            $('#update-form').on('submit', function (e) {
                let isValid = true;
                const username = $('#username').val();
                const email = $('#email').val();

                // Username validation
                if (username.length < 5 || username.length > 20 || !/^[a-zA-Z0-9-_]+$/.test(username)) {
                    alert('Username must be 5-20 characters long and contain only letters, numbers, dashes, or underscores.');
                    isValid = false;
                }

                // Email validation
                if (!/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(email)) {
                    alert('Please enter a valid email address.');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault(); // Prevent form submission if validation fails
                }
            });
        });
    </script>
</body>
</html>
