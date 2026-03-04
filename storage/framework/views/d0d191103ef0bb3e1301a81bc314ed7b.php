<?php $__env->startSection('title', 'Recent Activities'); ?>

<?php $__env->startSection('content_header'); ?>
    <div>
        <h1 class="text-success font-weight-bold mb-0">Recent Activities</h1>
        <small class="text-muted">Login and system activities for your school staff</small>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?php echo e(number_format($kpis['total_logs'] ?? 0)); ?></h3>
                    <p>Total Activity Logs</p>
                </div>
                <div class="icon">
                    <i class="fas fa-history"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-12">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?php echo e($kpis['last_activity'] ? \Carbon\Carbon::parse($kpis['last_activity'])->diffForHumans() : 'No activity'); ?></h3>
                    <p>Last Activity Detected</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Activity Log</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Time</th>
                                    <th>User</th>
                                    <th>IP Address</th>
                                    <th>User Agent</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e(\Carbon\Carbon::parse($activity->login_at)->format('d M Y H:i')); ?></td>
                                        <td><?php echo e($activity->user->name ?? 'N/A'); ?></td>
                                        <td><code><?php echo e($activity->ip_address); ?></code></td>
                                        <td class="small text-muted"><?php echo e(Str::limit($activity->user_agent, 50)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted">
                                            <i class="fas fa-user-clock fa-3x mb-3"></i>
                                            <p class="mb-0">No recent activities recorded.</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <?php echo e($activities->links()); ?>

                </div>
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

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\ZERIXA\WebApps\emas\resources\views/user/activities/index.blade.php ENDPATH**/ ?>