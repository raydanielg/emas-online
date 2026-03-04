<?php $__env->startSection('title', 'Backup & Restore'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="text-success font-weight-bold">System Backup & Restore</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning text-right">
                    <button class="btn btn-dark shadow-sm"><i class="fas fa-database mr-1"></i> Create Manual Backup</button>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="bg-dark">
                            <tr>
                                <th>File Name</th>
                                <th>Size</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>backup_2024_03_01.sql</td>
                                <td>15.4 MB</td>
                                <td><span class="badge badge-info">Full DB</span></td>
                                <td>01 Mar, 2024</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-success"><i class="fas fa-download"></i></button>
                                        <button class="btn btn-sm btn-warning"><i class="fas fa-undo"></i></button>
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\ZERIXA\WebApps\emas\resources\views/admin/settings/backup.blade.php ENDPATH**/ ?>