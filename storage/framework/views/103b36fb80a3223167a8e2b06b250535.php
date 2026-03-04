<?php $__env->startSection('title', 'General Settings'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="text-success font-weight-bold">General System Settings</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold"><i class="fas fa-cog mr-1"></i> System Branding & Localization</h3>
                </div>
                <form action="#" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>System Name</label>
                                <input type="text" class="form-control" name="system_name" value="EMAS - School Management">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Support Email</label>
                                <input type="email" class="form-control" name="support_email" value="support@emas.co.tz">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Primary Theme Color</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="#28a745" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-square text-success"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Accent Color (Yellow)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="#ffc107" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-square text-warning"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-right">
                        <button type="submit" class="btn btn-warning shadow-sm">Update Settings</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
        .bg-warning { background-color: #ffc107 !important; }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\ZERIXA\WebApps\emas\resources\views/admin/settings/general.blade.php ENDPATH**/ ?>