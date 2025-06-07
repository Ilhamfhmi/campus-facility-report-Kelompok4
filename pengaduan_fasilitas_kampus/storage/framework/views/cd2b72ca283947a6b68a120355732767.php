<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Manajemen Pengaduan Fasilitas Kampus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            background-color: #001f3f;
        }
        .sidebar a {
            color: #ffffff;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #004080;
            border-left: 5px solid #ffc107;
        }
        .sidebar h4 {
            color: #ffffff;
            padding: 20px;
        }
        .content {
            padding: 30px;
        }
    </style>
</head>
<body>

<?php if(auth()->guard()->check()): ?>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar p-3">
        <h4><i class="bx bx-building-house me-2"></i>Inventory Pengaduan</h4>
        <a href="<?php echo e(route('dashboard')); ?>" class="<?php echo e(request()->is('dashboard') ? 'active' : ''); ?>"><i class="bx bx-home me-2"></i> Dashboard</a>
        <a href="<?php echo e(route('users.index')); ?>" class="<?php echo e(request()->is('users*') ? 'active' : ''); ?>"><i class="bx bx-user me-2"></i> User Management</a>
        <a href="<?php echo e(route('officer_responses.index')); ?>" class="<?php echo e(request()->is('officer_responses*') ? 'active' : ''); ?>"><i class="bx bx-message-square-dots me-2"></i> Officer Response</a>
        <a href="<?php echo e(route('facility_categories.index')); ?>" class="<?php echo e(request()->is('facility_categories*') ? 'active' : ''); ?>"><i class="bx bx-category me-2"></i> Facility Category</a>
        <a href="<?php echo e(route('damage_reports.index')); ?>" class="<?php echo e(request()->is('damage_reports*') ? 'active' : ''); ?>"><i class="bx bx-error me-2"></i> Damage Report</a>
        <a href="<?php echo e(route('campus_locations.index')); ?>" class="<?php echo e(request()->is('campus_locations*') ? 'active' : ''); ?>"><i class="bx bx-map me-2"></i> Campus Location</a>
        <a href="<?php echo e(route('logout')); ?>"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="mt-3 text-danger">
            <i class="bx bx-log-out me-2"></i> Logout
        </a>
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
            <?php echo csrf_field(); ?>
        </form>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1">
        <div class="content">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if(auth()->guard()->guest()): ?>
<!-- Jika belum login, tampilkan konten tanpa sidebar -->
<div class="container py-5">
    <?php echo $__env->yieldContent('content'); ?>
</div>
<?php endif; ?>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\campus-facility-report-Kelompok4\pengaduan_fasilitas_kampus\resources\views/layouts/app.blade.php ENDPATH**/ ?>