<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Perfect Fitness Gym</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f4f8;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #1a5f7a;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .stat-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .stat-icon {
            font-size: 2em;
            margin-bottom: 10px;
        }
        .stat-title {
            font-size: 0.9em;
            color: #666;
        }
        .stat-value {
            font-size: 1.5em;
            font-weight: bold;
            margin: 5px 0;
        }
        .stat-change {
            font-size: 0.8em;
            color: #4caf50;
        }
        .activity-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .activity-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .activity-title {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 15px;
            color: #1a5f7a;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #1a5f7a;
        }
        .membership-item {
            background-color: #f2f2f2;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
        }
        .membership-name {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .membership-details {
            font-size: 0.9em;
            color: #666;
        }
    </style>
    <?php include APP_DIR.'views/templates/adminsidebarstyle.php'; ?>
</head>
<body>
<?php include APP_DIR.'views/templates/adminsidebar.php'; ?>
    <div class="header">
        <h1 style="margin: 0;">Perfect Fitness Gym - Admin Dashboard</h1>
        <p style="margin: 10px 0 0;">Empowering health through data-driven insights</p>
    </div>

    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon" style="color: #3498db;"><i class="fas fa-users"></i></div>
                <div class="stat-title">Total Members</div>
                <div class="stat-value"><?= $total_users ?></div>
                <div class="stat-change">+<?= $new_users_this_month ?> this month</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="color: #9b59b6;"><i class="fas fa-dumbbell"></i></div>
                <div class="stat-title">Total Classes</div>
                <div class="stat-value"><?= $total_classes ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="color: #2ecc71;"><i class="fas fa-calendar-check"></i></div>
                <div class="stat-title">Total Bookings</div>
                <div class="stat-value"><?= $total_bookings ?></div>
                <div class="stat-change">+<?= $new_bookings_this_month ?> this month</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="color: #f1c40f;"><i class="fas fa-id-card"></i></div>
                <div class="stat-title">Active Memberships</div>
                <div class="stat-value"><?= $active_memberships ?></div>
            </div>
        </div>

        <div class="activity-grid">
            <div class="activity-card">
                <div class="activity-title">Recent Bookings</div>
                <table>
                    <thead>
                        <tr>
                            <th>Member</th>
                            <th>Class</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($recent_bookings)): ?>
                            <?php foreach ($recent_bookings as $booking): ?>
                                <tr>
                                    <td><?= htmlspecialchars($booking['first_name'] . ' ' . $booking['last_name']) ?></td>
                                    <td><?= htmlspecialchars($booking['type']) ?></td>
                                    <td><?= date('M j, Y g:i A', strtotime($booking['booking_date'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" style="text-align: center; color: #666;">No recent bookings</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="activity-card">
                <div class="activity-title">Recent Memberships</div>
                <?php if (!empty($recent_memberships)): ?>
                    <?php foreach ($recent_memberships as $membership): ?>
                        <div class="membership-item">
                            <div class="membership-name">
                                <?= htmlspecialchars($membership['first_name'] . ' ' . $membership['last_name']) ?>
                            </div>
                            <div class="membership-details">
                                <i class="fas fa-tag" style="margin-right: 5px;"></i><?= htmlspecialchars($membership['type']) ?> |
                                <i class="fas fa-clock" style="margin-right: 5px;"></i><?= htmlspecialchars($membership['duration_months']) ?> months |
                                Started: <?= date('M j, Y', strtotime($membership['start_date'])) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div style="text-align: center; color: #666; padding: 20px;">No recent memberships</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
