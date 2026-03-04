<?php $__env->startSection('title', 'Classes Management'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-success font-weight-bold">Classes Management</h1>
        <a href="<?php echo e(route('admin.classes.create')); ?>" class="btn btn-warning shadow-sm">
            <i class="fas fa-plus-circle mr-1"></i> Add New Class
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="card card-outline card-success shadow-sm">
        <div class="card-header bg-warning">
            <h3 class="card-title text-dark font-weight-bold">All Classes</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Global Class Name</th>
                            <th>Level</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="font-weight-bold"><?php echo e($class->name); ?></td>
                                <td>
                                    <span class="badge badge-info"><?php echo e($class->level); ?></span>
                                </td>
                                <td class="text-right">
                                    <form action="<?php echo e(route('admin.classes.destroy', $class)); ?>" method="POST" onsubmit="return confirm('Delete this global class?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-xs btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <p class="mb-0">No classes found.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            <?php echo e($classes->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\ZERIXA\WebApps\emas\resources\views/admin/classes/index.blade.php ENDPATH**/ ?>