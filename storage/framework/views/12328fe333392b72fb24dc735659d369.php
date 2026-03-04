<?php $__env->startSection('title', 'Latest Results'); ?>

<?php $__env->startSection('content_header'); ?>
    <div>
        <h1 class="text-success font-weight-bold mb-0">Latest Uploaded Results</h1>
        <small class="text-muted">Most recent examination results uploaded for your school</small>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?php echo e(number_format($kpis['total_results'] ?? 0)); ?></h3>
                    <p>Total Result Records</p>
                </div>
                <div class="icon">
                    <i class="fas fa-poll"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-12">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?php echo e($kpis['last_upload'] ? $kpis['last_upload']->diffForHumans() : 'No uploads'); ?></h3>
                    <p>Last Uploaded</p>
                </div>
                <div class="icon">
                    <i class="fas fa-cloud-upload-alt"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Recent Results</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Student</th>
                                    <th>Subject</th>
                                    <th>Exam</th>
                                    <th class="text-center">Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($result->created_at->format('d M Y H:i')); ?></td>
                                        <td><?php echo e($result->student->full_name ?? 'N/A'); ?></td>
                                        <td><?php echo e($result->subject->name ?? 'N/A'); ?></td>
                                        <td><?php echo e($result->exam->name ?? 'N/A'); ?></td>
                                        <td class="text-center font-weight-bold"><?php echo e($result->score); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <i class="fas fa-file-invoice fa-3x mb-3"></i>
                                            <p class="mb-0">No results found for your school.</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <?php echo e($results->links()); ?>

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

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\ZERIXA\WebApps\emas\resources\views/user/results/latest.blade.php ENDPATH**/ ?>