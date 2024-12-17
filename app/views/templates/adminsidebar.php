<!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <a href="#" class="navbar-brand mx-3 mb-4">
            <strong>Perfect Fitness Gym</strong>
        </a>
        <a class="nav-link" href="#">
            <span class="icon"><i class="fas fa-user"></i></span>
            <?=html_escape(get_username(get_user_id()));?>
        </a>
        <a href="<?=site_url('admin')?>" class="active">
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
        <a href="<?= site_url('admin/bookings'); ?>">
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