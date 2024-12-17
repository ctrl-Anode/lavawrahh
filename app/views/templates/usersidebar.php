<div class="bg-gray-800 text-white w-64 min-h-screen flex flex-col">
    <div class="p-4">
        <h2 class="text-2xl font-bold">Perfect Fitness Gym</h2>
    </div>
    <nav class="flex-1">
        <a href="<?=site_url('user/profile')?>" class="block py-2 px-4 hover:bg-gray-700 transition duration-200">
            <i class="fas fa-user mr-2"></i> Profile
            
        </a>
        <a href="<?=site_url('dashboard')?>" class="block py-2 px-4 hover:bg-gray-700 transition duration-200">
            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
        </a>
        <a href="<?=site_url('user/memberships/display')?>" class="block py-2 px-4 hover:bg-gray-700 transition duration-200">
            <i class="fas fa-plus-circle mr-2"></i> Avail Membership Plan
        </a>
        <a href="<?=site_url('user/class/display')?>" class="block py-2 px-4 hover:bg-gray-700 transition duration-200">
            <i class="fas fa-dumbbell mr-2"></i> Book Class
        </a>
        <a href="<?=site_url('user/booked_classes')?>" class="block py-2 px-4 hover:bg-gray-700 transition duration-200">
            <i class="fas fa-calendar-alt mr-2"></i> My Booked Classes
        </a>
        <a href="#" class="block py-2 px-4 hover:bg-gray-700 transition duration-200">
            <i class="fas fa-money-bill-wave mr-2"></i> Payments
        </a>
    </nav>
    <div class="p-4">
        <a href="<?=site_url('user/user_logout');?>" class="block py-2 px-4 bg-red-500 text-white rounded hover:bg-red-600 transition duration-200">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </a>
    </div>
</div>
