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
            <h1 class="mb-4"><i class="fas fa-user-alt me-2"></i>Your Profile</h1>
            
            <!-- Display Profile Card -->
            <div id="profile-card" class="card">
                <div class="card-body">
                    <form action="<?=site_url('user/user_logout');?>">
                        <h5 class="card-title mb-4">
                            <i class="fas fa-user-alt me-2"></i>
                            <?= html_escape($user['first_name'] . ' ' . ($user['middle_name'] ? $user['middle_name'] . ' ' : '') . $user['last_name']); ?>
                        </h5>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="card-text"><strong>Username:</strong> <?= html_escape($user['username']); ?></p>
                                <p class="card-text"><strong>Email:</strong> <?= html_escape($user['email']); ?></p>
                                <p class="card-text"><strong>Contact:</strong> <?= html_escape($user['contact']); ?></p>
                                <p class="card-text"><strong>Gender:</strong> <?= ucfirst(html_escape($user['gender'])); ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="card-text"><strong>Address:</strong> <?= html_escape($user['address']); ?></p>
                                <p class="card-text"><strong>Created:</strong> <?= date('F j, Y', strtotime($user['created_at'])); ?></p>
                                <p class="card-text"><strong>Last Updated:</strong> <?= date('F j, Y', strtotime($user['updated_at'])); ?></p>
                            </div>
                        </div>
                        
                        <!-- Active Membership Information -->
                        <div class="mt-4">
                            <h6 class="mb-3"><i class="fas fa-crown me-2"></i>Active Membership</h6>
                            <?php if(isset($active_membership) && $active_membership): ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="card-text"><strong>Plan:</strong> <?= html_escape($active_membership['type']); ?></p>
                                        <p class="card-text"><strong>Duration:</strong> <?= html_escape($active_membership['duration_months']); ?> months</p>
                                        <p class="card-text"><strong>Price:</strong> ₱<?= number_format($active_membership['price'], 2); ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="card-text"><strong>Start Date:</strong> <?= date('F j, Y', strtotime($active_membership['start_date'])); ?></p>
                                        <p class="card-text"><small class="text-muted"><?= html_escape($active_membership['info']); ?></small></p>
                                        <p class="card-text"><small class="text-muted">Status: <?= html_escape($active_membership['status']); ?></small></p>
                                        <?php if($active_membership['terms_accepted']): ?>
                                            <p class="card-text"><small class="text-success"><i class="fas fa-check-circle"></i> Terms & Conditions Accepted</small></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <p class="card-text text-muted">No active membership plan.</p>
                                <a href="<?= site_url('membership/avail'); ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus me-1"></i>Avail Membership
                                </a>
                            <?php endif; ?>
                        </div>

                        <div class="mt-4">
                            <button class="btn btn-sm btn-danger">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </button>
                            <button type="button" id="update-profile-btn" class="btn btn-sm btn-primary ms-2">
                                <i class="fas fa-edit me-1"></i>Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Update Form (Hidden by Default) -->
            <form id="update-form" class="hidden card" action="<?= site_url('user/update_profile'); ?>" method="POST">
                <div class="card-body">
                    <h5 class="card-title mb-4">Update Profile</h5>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?= html_escape($user['first_name']); ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?= html_escape($user['middle_name']); ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?= html_escape($user['last_name']); ?>" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= html_escape($user['username']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= html_escape($user['email']); ?>" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="contact" class="form-label">Contact</label>
                            <input type="text" class="form-control" id="contact" name="contact" value="<?= html_escape($user['contact']); ?>" required>
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
                        <textarea class="form-control" id="address" name="address" rows="3" required><?= html_escape($user['address']); ?></textarea>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" id="cancel-update-btn" class="btn btn-secondary ms-2">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#update-profile-btn').click(function () {
                $('#profile-card').hide();
                $('#update-form').removeClass('hidden');
            });

            $('#cancel-update-btn').click(function () {
                $('#update-form').addClass('hidden');
                $('#profile-card').show();
            });

            $('#update-form').on('submit', function (e) {
                let isValid = true;
                const username = $('#username').val();
                const email = $('#email').val();
                const contact = $('#contact').val();

                if (username.length < 5 || username.length > 20 || !/^[a-zA-Z0-9-_]+$/.test(username)) {
                    alert('Username must be 5-20 characters long and contain only letters, numbers, dashes, or underscores.');
                    isValid = false;
                }

                if (!/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(email)) {
                    alert('Please enter a valid email address.');
                    isValid = false;
                }

                if (!/^\d{10,15}$/.test(contact.replace(/[^0-9]/g, ''))) {
                    alert('Please enter a valid contact number (10-15 digits).');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>
