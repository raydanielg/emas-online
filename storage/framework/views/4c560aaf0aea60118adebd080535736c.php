<?php $__env->startSection('title', 'Result Drafts'); ?>

<?php $__env->startSection('content_header'); ?>
    <div>
        <h1 class="text-success font-weight-bold mb-0">Pending Result Drafts</h1>
        <small class="text-muted">Results that are saved as drafts and not yet published</small>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?php echo e(number_format($kpis['total_drafts'] ?? 0)); ?></h3>
                    <p>Total Pending Drafts</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-signature"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-12">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?php echo e($kpis['oldest_draft'] ? $kpis['oldest_draft']->diffForHumans() : 'No drafts'); ?></h3>
                    <p>Oldest Draft Created</p>
                </div>
                <div class="icon">
                    <i class="fas fa-history"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Draft Records</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Created Date</th>
                                    <th>Student</th>
                                    <th>Subject</th>
                                    <th class="text-center">Score</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $drafts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $draft): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($draft->created_at->format('d M Y H:i')); ?></td>
                                        <td><?php echo e($draft->student->full_name ?? 'N/A'); ?></td>
                                        <td><?php echo e($draft->subject->name ?? 'N/A'); ?></td>
                                        <td class="text-center font-weight-bold"><?php echo e($draft->score); ?></td>
                                        <td><span class="badge badge-warning">Draft</span></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <i class="fas fa-clipboard-list fa-3x mb-3"></i>
                                            <p class="mb-0">No pending drafts found.</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <?php echo e($drafts->links()); ?>

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

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\ZERIXA\WebApps\emas\resources\views/user/results/drafts.blade.php ENDPATH**/ ?>