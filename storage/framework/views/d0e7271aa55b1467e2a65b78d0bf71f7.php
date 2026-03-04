<?php $__env->startSection('title', 'Login History'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="text-success font-weight-bold">User Login History</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold"><i class="fas fa-history mr-1"></i> System Access Logs</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="bg-dark">
                            <tr>
                                <th>User</th>
                                <th>IP Address</th>
                                <th>User Agent</th>
                                <th>Login Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($log->user->name ?? 'Unknown'); ?> (<?php echo e($log->user->email ?? 'N/A'); ?>)</td>
                                    <td><span class="badge badge-info"><?php echo e($log->ip_address); ?></span></td>
                                    <td><small><?php echo e(Str::limit($log->user_agent, 50)); ?></small></td>
                                    <td><?php echo e($log->login_at ? \Carbon\Carbon::parse($log->login_at)->format('d M, Y H:i:s') : $log->created_at->format('d M, Y H:i:s')); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">No login records found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white">
                    <?php echo e($logs->links()); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\ZERIXA\WebApps\emas\resources\views/admin/users/logs.blade.php ENDPATH**/ ?>