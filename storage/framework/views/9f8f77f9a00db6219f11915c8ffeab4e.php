<?php $__env->startSection('title', 'Generate Reports'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="text-success font-weight-bold">Reports Management</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline card-success shadow-sm text-center py-4">
                <div class="card-body">
                    <i class="fas fa-id-card fa-4x text-success mb-3"></i>
                    <h4 class="font-weight-bold">Student Report Cards</h4>
                    <p class="text-muted">Generate individual academic progress reports.</p>
                    <a href="<?php echo e(route('user.reports.cards')); ?>" class="btn btn-warning shadow-sm">Generate Now</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-outline card-success shadow-sm text-center py-4">
                <div class="card-body">
                    <i class="fas fa-users fa-4x text-info mb-3"></i>
                    <h4 class="font-weight-bold">Class Performance</h4>
                    <p class="text-muted">Generate summary reports for specific classes.</p>
                    <a href="<?php echo e(route('user.reports.class')); ?>" class="btn btn-warning shadow-sm">Generate Now</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-outline card-success shadow-sm text-center py-4">
                <div class="card-body">
                    <i class="fas fa-school fa-4x text-primary mb-3"></i>
                    <h4 class="font-weight-bold">Overall School Report</h4>
                    <p class="text-muted">Comprehensive school-wide academic analysis.</p>
                    <a href="<?php echo e(route('user.reports.school')); ?>" class="btn btn-warning shadow-sm">Generate Now</a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\ZERIXA\WebApps\emas\resources\views/user/reports/index.blade.php ENDPATH**/ ?>