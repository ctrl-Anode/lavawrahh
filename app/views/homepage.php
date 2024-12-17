<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Gym Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .stat-card {
            background-color: var(--primary-color);
            color: var(--text-color);
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }

        .stat-card h3 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .chart-container {
            position: relative;
            height: 300px;
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
        .text-lg { font-size: 1.125rem; }
        .font-bold { font-weight: bold; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <a href="#" class="navbar-brand mx-3 mb-4">
            <strong>Perfect Fitness Gym</strong>
        </a>
        <a class="nav-link" href="#">
            <span class="icon"><i class="fas fa-user"></i></span>
            <?=html_escape(get_username(get_user_id()));?>
        </a>
        <a href="<?=site_url('home')?>" class="active">
            <span class="icon"><i class="fas fa-tachometer-alt"></i></span> Dashboard
        </a>
        <a href="<?= site_url('auth/user/manage'); ?>">
            <span class="icon"><i class="fas fa-users"></i></span> Members
        </a>
        <a href="<?= site_url('auth/user/applications/manage'); ?>">
            <span class="icon"><i class="fas fa-clipboard-list"></i></span> Manage Membership Application
        </a>
        <a href="<?= site_url('auth/memberships/display'); ?>">
            <span class="icon"><i class="fas fa-clipboard-list"></i></span> Manage Membership Plan
        </a>
        <a href="<?= site_url('auth/memberships/apply'); ?>">
            <span class="icon"><i class="fas fa-plus-circle"></i></span> Add Membership Plan
        </a>
        <a href="<?= site_url('auth/class/display'); ?>">
            <span class="icon"><i class="fas fa-dumbbell"></i></span> Manage Class
        </a>
        <a href="<?= site_url('auth/user/class/manage'); ?>">
            <span class="icon"><i class="fas fa-calendar-alt"></i></span> Scheduled Classes
        </a>
        <a href="#">
            <span class="icon"><i class="fas fa-money-bill-wave"></i></span> Received Payments
        </a>
        <a href="<?= site_url('auth/terms/display'); ?>">
            <span class="icon"><i class="fas fa-clipboard-list"></i></span> Manage Terms & Conditions
        </a>
        <a href="<?=site_url('auth/logout');?>" class="mt-auto">
            <span class="icon"><i class="fas fa-sign-out-alt"></i></span> Logout
        </a>
    </div>

    <!-- Main content -->
    <div class="main-content" id="main-content">
        <div class="container">
            <h1 class="mb-4 text-lg font-bold">Dashboard</h1>
            
            <div class="stats-grid mb-4">
                <div class="stat-card">
                    <h3>250</h3>
                    <p>Active Members</p>
                </div>
                <div class="stat-card">
                    <h3>15</h3>
                    <p>Classes Today</p>
                </div>
                <div class="stat-card">
                    <h3>$5,280</h3>
                    <p>Revenue This Month</p>
                </div>
                <div class="stat-card">
                    <h3>98%</h3>
                    <p>Member Satisfaction</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <h2 class="text-lg font-bold mb-4">Membership Distribution</h2>
                        <div class="chart-container">
                            <canvas id="membershipChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <h2 class="text-lg font-bold mb-4">Revenue Trend</h2>
                        <div class="chart-container">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <h2 class="text-lg font-bold mb-4">Recent Activities</h2>
                <ul class="list-group">
                    <li class="list-group-item">New member joined: John Doe</li>
                    <li class="list-group-item">Class 'Yoga Basics' scheduled for tomorrow</li>
                    <li class="list-group-item">Payment received: $99 from Jane Smith</li>
                    <li class="list-group-item">Equipment maintenance scheduled for next week</li>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const toggleBtn = document.createElement('button');
            toggleBtn.innerHTML = '☰';
            toggleBtn.style.position = 'fixed';
            toggleBtn.style.top = '10px';
            toggleBtn.style.left = '10px';
            toggleBtn.style.zIndex = '1001';
            toggleBtn.style.display = 'none';
            document.body.appendChild(toggleBtn);

            function toggleSidebar() {
                sidebar.classList.toggle('active');
                mainContent.classList.toggle('active');
            }

            toggleBtn.addEventListener('click', toggleSidebar);

            function checkWidth() {
                if (window.innerWidth <= 768) {
                    toggleBtn.style.display = 'block';
                } else {
                    toggleBtn.style.display = 'none';
                    sidebar.classList.remove('active');
                    mainContent.classList.remove('active');
                }
            }

            window.addEventListener('resize', checkWidth);
            checkWidth();
        });

        // Charts
        const membershipCtx = document.getElementById('membershipChart').getContext('2d');
        new Chart(membershipCtx, {
            type: 'doughnut',
            data: {
                labels: ['Basic', 'Standard', 'Premium'],
                datasets: [{
                    data: [30, 50, 20],
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
                }]
            }
        });

        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Revenue',
                    data: [3000, 3500, 4000, 3800, 4200, 5280],
                    borderColor: '#36A2EB',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>