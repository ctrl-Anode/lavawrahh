<!DOCTYPE html>
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
            background-color: #f8f9fa;
        }
        .main-content {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .booking-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            flex: 1 1 calc(33.333% - 20px); /* Three cards per row */
            max-width: calc(33.333% - 20px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .booking-card h5 {
            margin-bottom: 15px;
            color: #007bff;
        }
        .badge {
            font-size: 14px;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        @media (max-width: 768px) {
            .booking-card {
                flex: 1 1 100%; /* Full-width on smaller screens */
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">My Booked Classes</h2>
            </div>
            <div class="card-body">
                <?php if (!empty($bookings)): ?>
                    <div class="card-container">
                        <?php foreach ($bookings as $booking): ?>
                            <div class="booking-card">
                                <h5><?= htmlspecialchars($booking['type']); ?></h5>
                                <p><strong>Description:</strong> <?= htmlspecialchars($booking['description']); ?></p>
                                <p><strong>Duration:</strong> <?= htmlspecialchars($booking['duration_minutes']); ?> mins</p>
                                <p><strong>Instructor:</strong> <?= htmlspecialchars($booking['instructor']); ?></p>
                                <p><strong>Schedule:</strong> <?= date('F j, Y g:i A', strtotime($booking['schedule'])); ?></p>
                                <p>
                                    <strong>Status:</strong> 
                                    <?php $schedule = strtotime($booking['schedule']); $now = time(); ?>
                                    <?php if ($schedule < $now): ?>
                                        <span class="badge bg-secondary">Completed</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">Upcoming</span>
                                    <?php endif; ?>
                                </p>
                                <p><strong>Booking Date:</strong> <?= date('F j, Y g:i A', strtotime($booking['booking_date'])); ?></p>
                                <?php if ($schedule > $now): ?>
                                    <a href="<?= site_url('user/cancel_booking/' . $booking['booking_id']); ?>" 
                                       class="btn btn-danger"
                                       onclick="return confirm('Are you sure you want to cancel this booking?');">
                                        <i class="fas fa-times"></i> Cancel
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> You haven't booked any classes yet. 
                        <a href="<?= site_url('user/class/display'); ?>" class="alert-link">Browse available classes</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
