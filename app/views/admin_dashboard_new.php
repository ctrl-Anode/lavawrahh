<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Perfect Fitness Gym</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <?php include APP_DIR . 'views/templates/admin_sidebar.php'; ?>

    <div class="ml-64 p-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Admin Dashboard</h1>
            <p class="text-gray-600">Overview of gym performance and statistics</p>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-2 gap-6 mb-6">
            <a href="<?= site_url('schedule/monitor') ?>" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                        <i class="fas fa-calendar-alt text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-lg font-semibold text-gray-800">Schedule Monitor</h2>
                        <p class="text-gray-600">View and manage class schedules</p>
                    </div>
                </div>
            </a>
            <a href="<?= site_url('auth/class/display') ?>" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-500">
                        <i class="fas fa-dumbbell text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-lg font-semibold text-gray-800">Manage Classes</h2>
                        <p class="text-gray-600">Add, edit, or remove classes</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <!-- Members -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Total Members</p>
                        <p class="text-xl font-semibold"><?= $total_users ?></p>
                        <p class="text-sm text-green-500">+<?= $new_users_this_month ?> this month</p>
                    </div>
                </div>
            </div>

            <!-- Classes -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-500">
                        <i class="fas fa-dumbbell text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Total Classes</p>
                        <p class="text-xl font-semibold"><?= $total_classes ?></p>
                    </div>
                </div>
            </div>

            <!-- Bookings -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-500">
                        <i class="fas fa-calendar-check text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Total Bookings</p>
                        <p class="text-xl font-semibold"><?= $total_bookings ?></p>
                        <p class="text-sm text-green-500">+<?= $new_bookings_this_month ?> this month</p>
                    </div>
                </div>
            </div>

            <!-- Active Memberships -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-500">
                        <i class="fas fa-id-card text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Active Memberships</p>
                        <p class="text-xl font-semibold"><?= $active_memberships ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Bookings -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold mb-4">Recent Bookings</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Member</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Class</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recent_bookings)): ?>
                                <?php foreach ($recent_bookings as $booking): ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?= htmlspecialchars($booking['first_name'] . ' ' . $booking['last_name']) ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?= htmlspecialchars($booking['type']) ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?= date('M j, Y g:i A', strtotime($booking['booking_date'])) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                        No recent bookings
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Memberships -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold mb-4">Recent Memberships</h2>
                <?php if (!empty($recent_memberships)): ?>
                    <div class="space-y-4">
                        <?php foreach ($recent_memberships as $membership): ?>
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-semibold">
                                            <?= htmlspecialchars($membership['first_name'] . ' ' . $membership['last_name']) ?>
                                        </h3>
                                        <p class="text-sm text-gray-500">
                                            <i class="fas fa-tag mr-1"></i>
                                            <?= htmlspecialchars($membership['type']) ?>
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            <i class="fas fa-clock mr-1"></i>
                                            <?= htmlspecialchars($membership['duration_months']) ?> months
                                        </p>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        Started: <?= date('M j, Y', strtotime($membership['start_date'])) ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <p class="text-gray-500">No recent memberships</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
