<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Dashboard - Perfect Fitness Gym</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <?php include APP_DIR . 'views/templates/usersidebar.php'; ?>

    <div class="ml-64 p-8">
        <!-- Welcome Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        Welcome back, <?= htmlspecialchars($user['first_name']) ?>!
                    </h1>
                    <p class="text-gray-600 mt-1">Here's your fitness journey overview</p>
                </div>
                <?php if (isset($membership) && $membership): ?>
                    <div class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-semibold">
                        <i class="fas fa-check-circle mr-2"></i>Active Member
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Summary Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                        <i class="fas fa-calendar-check text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Total Classes</p>
                        <p class="text-xl font-semibold"><?= $summary['total_classes_booked'] ?></p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-500">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Upcoming</p>
                        <p class="text-xl font-semibold"><?= $summary['upcoming_classes'] ?></p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-500">
                        <i class="fas fa-check-double text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Completed</p>
                        <p class="text-xl font-semibold"><?= $summary['completed_classes'] ?></p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-500">
                        <i class="fas fa-dumbbell text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Class Types</p>
                        <p class="text-xl font-semibold"><?= $summary['class_types_attended'] ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Membership Status -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold mb-4">Membership Status</h2>
                <?php if (isset($membership) && $membership): ?>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Plan</span>
                            <span class="font-semibold"><?= htmlspecialchars($membership['type']) ?></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Valid Until</span>
                            <span class="font-semibold"><?= date('M j, Y', strtotime($membership_status['end_date'])) ?></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Days Remaining</span>
                            <span class="font-semibold"><?= $membership_status['days_remaining'] ?> days</span>
                        </div>
                        <div class="mt-4">
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <?php 
                                $progress = ($membership_status['days_used'] / $membership_status['total_days']) * 100;
                                ?>
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: <?= $progress ?>%"></div>
                            </div>
                            <div class="text-sm text-gray-500 mt-2 text-center">
                                <?= $membership_status['days_used'] ?> days used of <?= $membership_status['total_days'] ?> days
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="text-center py-6">
                        <i class="fas fa-user-clock text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500 mb-4">No active membership</p>
                        <a href="<?= site_url('user/memberships/display') ?>" 
                           class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">
                            View Plans
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Class Statistics -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold mb-4">Class Statistics</h2>
                <?php if (!empty($class_stats)): ?>
                    <div class="space-y-4">
                        <?php foreach ($class_stats as $type => $stats): ?>
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-gray-600"><?= htmlspecialchars($type) ?></span>
                                    <span class="font-semibold"><?= $stats['total'] ?> classes</span>
                                </div>
                                <div class="flex space-x-2 text-sm">
                                    <span class="text-green-600">
                                        <i class="fas fa-clock mr-1"></i><?= $stats['upcoming'] ?> upcoming
                                    </span>
                                    <span class="text-gray-500">
                                        <i class="fas fa-check mr-1"></i><?= $stats['completed'] ?> completed
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-6">
                        <i class="fas fa-chart-bar text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">No class history yet</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Upcoming Classes -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold mb-4">Upcoming Classes</h2>
                <?php if (!empty($upcoming_classes)): ?>
                    <div class="space-y-4">
                        <?php foreach (array_slice($upcoming_classes, 0, 3) as $class): ?>
                            <div class="border-l-4 border-blue-500 pl-4">
                                <div class="font-semibold"><?= htmlspecialchars($class['type']) ?></div>
                                <div class="text-sm text-gray-500">
                                    <i class="far fa-calendar mr-1"></i>
                                    <?= date('M j, Y', strtotime($class['schedule'])) ?>
                                </div>
                                <div class="text-sm text-gray-500">
                                    <i class="far fa-clock mr-1"></i>
                                    <?= date('g:i A', strtotime($class['schedule'])) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php if (count($upcoming_classes) > 3): ?>
                            <a href="<?= site_url('user/booked_classes') ?>" 
                               class="text-blue-500 hover:text-blue-600 text-sm">
                                View all upcoming classes
                            </a>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-6">
                        <i class="far fa-calendar-alt text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500 mb-4">No upcoming classes</p>
                        <a href="<?= site_url('user/class/display') ?>" 
                           class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">
                            Book a Class
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Recent Activities -->
        <?php if (!empty($recent_activities)): ?>
            <div class="mt-6 bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold mb-4">Recent Activities</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Class</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Schedule</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instructor</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($recent_activities as $activity): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            <?= htmlspecialchars($activity['type']) ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">
                                            <?= date('M j, Y g:i A', strtotime($activity['schedule'])) ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">
                                            <?= htmlspecialchars($activity['instructor']) ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php if (strtotime($activity['schedule']) > time()): ?>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Upcoming
                                            </span>
                                        <?php else: ?>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                Completed
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
