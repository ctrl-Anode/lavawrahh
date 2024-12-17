<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <a href="#" class="navbar-brand mx-3 mb-4">
        <strong>Perfect Fitness Gym</strong>
    </a>
    <nav class="nav flex-column">
        <a class="nav-link" href="<?= site_url('admin/dashboard') ?>">
            <i class="fas fa-tachometer-alt me-2"></i>
            Dashboard
        </a>
        
        <!-- Schedule Management -->
        <div class="nav-section">
            <a class="nav-link" href="<?= site_url('schedule') ?>">
                <i class="fas fa-calendar-alt me-2"></i>
                Schedule List
            </a>
            <a class="nav-link" href="<?= site_url('schedule/monitor') ?>">
                <i class="fas fa-clock me-2"></i>
                Schedule Monitor
            </a>
        </div>

        <!-- Class Management -->
        <div class="nav-section">
            <a class="nav-link" href="<?= site_url('auth/class/display') ?>">
                <i class="fas fa-dumbbell me-2"></i>
                Manage Classes
            </a>
            <a class="nav-link" href="<?= site_url('auth/class/add') ?>">
                <i class="fas fa-plus-circle me-2"></i>
                Add New Class
            </a>
            <a class="nav-link" href="<?= site_url('admin/bookings') ?>">
                <i class="fas fa-calendar-check me-2"></i>
                Manage Bookings
            </a>
        </div>

        <!-- Membership Management -->
        <div class="nav-section">
            <a class="nav-link" href="<?= site_url('auth/memberships/display') ?>">
                <i class="fas fa-id-card me-2"></i>
                Manage Memberships
            </a>
            <a class="nav-link" href="<?= site_url('auth/user/applications/manage') ?>">
                <i class="fas fa-file-alt me-2"></i>
                Membership Applications
            </a>
        </div>

        <!-- User Management -->
        <div class="nav-section">
            <a class="nav-link" href="<?= site_url('auth/user/manage') ?>">
                <i class="fas fa-users me-2"></i>
                Manage Users
            </a>
        </div>

        <!-- Settings -->
        <div class="nav-section">
            <a class="nav-link" href="<?= site_url('auth/terms/display') ?>">
                <i class="fas fa-file-contract me-2"></i>
                Terms & Conditions
            </a>
        </div>
    </nav>
    
    <!-- Logout -->
    <div class="mt-auto p-3">
        <a class="nav-link text-danger" href="<?= site_url('auth/logout') ?>">
            <i class="fas fa-sign-out-alt me-2"></i>
            Logout
        </a>
    </div>
</div>

<style>
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 250px;
        background-color: #343a40;
        padding-top: 1rem;
        display: flex;
        flex-direction: column;
        z-index: 1000;
    }

    .sidebar .navbar-brand {
        color: #fff;
        text-decoration: none;
        padding: 1rem;
        font-size: 1.25rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar .nav-section {
        padding: 0.5rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar .nav-link {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        padding: 0.75rem 1rem;
        transition: all 0.3s;
        display: flex;
        align-items: center;
    }

    .sidebar .nav-link:hover {
        color: #fff;
        background-color: rgba(255, 255, 255, 0.1);
    }

    .sidebar .nav-link i {
        width: 20px;
        text-align: center;
        margin-right: 0.75rem;
    }

    .sidebar .nav-link.active {
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
        border-left: 4px solid #0d6efd;
    }

    .sidebar .text-danger {
        color: #dc3545 !important;
    }

    .sidebar .text-danger:hover {
        background-color: rgba(220, 53, 69, 0.1);
    }
</style>
