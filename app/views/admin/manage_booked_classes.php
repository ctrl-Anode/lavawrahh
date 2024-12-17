<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Booked Classes - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .main-content {
            padding: 20px;
            margin-left: 250px; /* Adjust based on your sidebar width */
        }
        .status-badge {
            font-size: 0.85rem;
            padding: 0.35em 0.65em;
        }
        .table-actions {
            white-space: nowrap;
        }
        .btn-xs {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }
    </style>
    <?php $this->call->view('templates/adminsidebarstyle'); ?>
</head>
<body>
    <?php $this->call->view('templates/adminsidebar'); ?>

    <div class="main-content">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col">
                    <h2>Manage Booked Classes</h2>
                </div>
            </div>

            <?php if ($session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $session->flashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if ($session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $session->flashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="bookingsTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Class</th>
                                    <th>User</th>
                                    <th>Schedule</th>
                                    <th>Duration</th>
                                    <th>Instructor</th>
                                    <th>Booking Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bookings as $booking): ?>
                                    <tr>
                                        <td>
                                            <strong><?= htmlspecialchars($booking['type']) ?></strong>
                                            <br>
                                            <small class="text-muted"><?= htmlspecialchars($booking['description']) ?></small>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($booking['first_name'] . ' ' . $booking['last_name']) ?>
                                            <br>
                                            <small class="text-muted"><?= htmlspecialchars($booking['email']) ?></small>
                                        </td>
                                        <td><?= date('F j, Y g:i A', strtotime($booking['schedule'])) ?></td>
                                        <td><?= htmlspecialchars($booking['duration_minutes']) ?> mins</td>
                                        <td><?= htmlspecialchars($booking['instructor']) ?></td>
                                        <td><?= date('F j, Y g:i A', strtotime($booking['booking_date'])) ?></td>
                                        <td>
                                            <?php
                                            $status_class = '';
                                            $status = $booking['status'] ?? 'pending';
                                            switch($status) {
                                                case 'pending':
                                                    $status_class = 'bg-warning';
                                                    break;
                                                case 'confirmed':
                                                    $status_class = 'bg-success';
                                                    break;
                                                case 'cancelled':
                                                    $status_class = 'bg-danger';
                                                    break;
                                                case 'completed':
                                                    $status_class = 'bg-info';
                                                    break;
                                                default:
                                                    $status_class = 'bg-secondary';
                                            }
                                            ?>
                                            <span class="badge <?= $status_class ?> status-badge">
                                                <?= ucfirst(htmlspecialchars($booking['status'])) ?>
                                            </span>
                                        </td>
                                        <td class="table-actions">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-bs-toggle="dropdown">
                                                    Update Status
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <form action="<?= site_url('admin/update_booking_status') ?>" method="post" style="display: inline;">
                                                            <input type="hidden" name="booking_id" value="<?= $booking['booking_id'] ?>">
                                                            <input type="hidden" name="status" value="confirmed">
                                                            <button type="submit" class="dropdown-item">Confirm</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="<?= site_url('admin/update_booking_status') ?>" method="post" style="display: inline;">
                                                            <input type="hidden" name="booking_id" value="<?= $booking['booking_id'] ?>">
                                                            <input type="hidden" name="status" value="cancelled">
                                                            <button type="submit" class="dropdown-item">Cancel</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="<?= site_url('admin/update_booking_status') ?>" method="post" style="display: inline;">
                                                            <input type="hidden" name="booking_id" value="<?= $booking['booking_id'] ?>">
                                                            <input type="hidden" name="status" value="completed">
                                                            <button type="submit" class="dropdown-item">Mark as Completed</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                                <a href="<?= site_url('admin/delete_booking/' . $booking['booking_id']) ?>" 
                                                   class="btn btn-danger btn-xs ms-1"
                                                   onclick="return confirm('Are you sure you want to delete this booking?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#bookingsTable').DataTable({
                order: [[2, 'desc']], // Sort by schedule by default
                pageLength: 25,
                language: {
                    search: "Search bookings:"
                }
            });
        });
    </script>
</body>
</html>
