<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Class Details - Perfect Fitness Gym</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <?php include APP_DIR . 'views/templates/adminsidebar_new.php'; ?>

    <div class="ml-64 p-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800"><?= htmlspecialchars($class['type']) ?></h1>
                    <p class="text-gray-600 mt-1"><?= htmlspecialchars($class['description']) ?></p>
                </div>
                <a href="<?= site_url('schedule') ?>" class="text-blue-500 hover:text-blue-600">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Schedule
                </a>
            </div>
        </div>

        <!-- Class Information -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-lg font-semibold mb-4">Class Information</h2>
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <div class="mb-4">
                        <span class="text-gray-500">Schedule:</span>
                        <div class="font-medium text-gray-900">
                            <?= date('F j, Y', strtotime($class['schedule'])) ?>
                            <span class="text-gray-500 ml-2">
                                <?= date('g:i A', strtotime($class['schedule'])) ?>
                            </span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <span class="text-gray-500">Duration:</span>
                        <div class="font-medium text-gray-900"><?= $class['duration_minutes'] ?> minutes</div>
                    </div>
                </div>
                <div>
                    <div class="mb-4">
                        <span class="text-gray-500">Instructor:</span>
                        <div class="font-medium text-gray-900"><?= htmlspecialchars($class['instructor']) ?></div>
                    </div>
                    <div class="mb-4">
                        <span class="text-gray-500">Price:</span>
                        <div class="font-medium text-gray-900">₱<?= number_format($class['price'], 2) ?></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booked Members -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold mb-4">Booked Members</h2>
            <?php if (!empty($bookings)): ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Member Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Contact</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Booking Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($bookings as $booking): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            <?= htmlspecialchars($booking['first_name'] . ' ' . $booking['last_name']) ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">
                                            <?= htmlspecialchars($booking['contact']) ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">
                                            <?= htmlspecialchars($booking['email']) ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">
                                            <?= date('M j, Y g:i A', strtotime($booking['booking_date'])) ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-4 text-gray-500">
                    No bookings for this class yet
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
