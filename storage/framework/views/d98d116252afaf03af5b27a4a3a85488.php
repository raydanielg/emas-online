<?php $__env->startSection('title', 'Exam List'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between">
        <h1 class="text-success font-weight-bold">Exam Management</h1>
        <a href="<?php echo e(route('user.exams.create')); ?>" class="btn btn-warning shadow-sm">
            <i class="fas fa-plus-circle mr-1"></i> Create New Exam
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Scheduled Exams</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="bg-dark">
                            <tr>
                                <th>Exam Name</th>
                                <th>Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($exam->name); ?></td>
                                    <td><?php echo e($exam->type); ?></td>
                                    <td><?php echo e($exam->start_date); ?></td>
                                    <td><?php echo e($exam->end_date); ?></td>
                                    <td>
                                        <span class="badge badge-<?php echo e($exam->is_active ? 'success' : 'secondary'); ?>">
                                            <?php echo e($exam->is_active ? 'Active' : 'Closed'); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?php echo e(route('user.exams.edit', $exam)); ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                            <form action="<?php echo e(route('user.exams.destroy', $exam)); ?>" method="POST" style="display:inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr><td colspan="6" class="text-center py-4 text-muted">No exams found.</td></tr>
                            <?php endif; ?>
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

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\ZERIXA\WebApps\emas\resources\views/user/exams/index.blade.php ENDPATH**/ ?>