<?php $__env->startSection('title', 'Schools Management'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between">
        <h1>Schools Management</h1>
        <a href="<?php echo e(route('schools.create')); ?>" class="btn btn-warning">
            <i class="fas fa-plus"></i> Add New School
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-success">
                <div class="card-header" style="background-color: #ffc107; color: #000;">
                    <h3 class="card-title">List of All Schools</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped">
                        <thead class="bg-dark">
                            <tr>
                                <th>Logo</th>
                                <th>School Name</th>
                                <th>Reg Number</th>
                                <th>Category</th>
                                <th>Level</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td>
                                        <?php if($school->logo): ?>
                                            <img src="<?php echo e(asset('storage/' . $school->logo)); ?>" width="40" class="img-circle">
                                        <?php else: ?>
                                            <i class="fas fa-school fa-2x text-success"></i>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($school->name); ?></td>
                                    <td><span class="badge badge-info"><?php echo e($school->registration_number); ?></span></td>
                                    <td><?php echo e($school->category); ?></td>
                                    <td><?php echo e($school->level); ?></td>
                                    <td>
                                        <?php if($school->status == 'Approved'): ?>
                                            <span class="badge badge-success">Approved</span>
                                        <?php elseif($school->status == 'Pending'): ?>
                                            <span class="badge badge-warning text-dark">Pending</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">Rejected</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?php echo e(route('schools.show', $school)); ?>" class="btn btn-sm btn-info" title="View"><i class="fas fa-eye"></i></a>
                                            <a href="<?php echo e(route('schools.edit', $school)); ?>" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>

                                            <?php if($school->status == 'Pending'): ?>
                                                <button type="button" class="btn btn-sm btn-success" title="Quick Approve"
                                                    data-toggle="modal" data-target="#quickApproveModal<?php echo e($school->id); ?>">
                                                    <i class="fas fa-check-circle"></i>
                                                </button>
                                            <?php endif; ?>

                                            <form action="<?php echo e(route('schools.destroy', $school)); ?>" method="POST" style="display:inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this school?')"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>

                                        <?php if($school->status == 'Pending'): ?>
                                            <div class="modal fade" id="quickApproveModal<?php echo e($school->id); ?>" tabindex="-1" role="dialog" aria-labelledby="quickApproveModalLabel<?php echo e($school->id); ?>" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="quickApproveModalLabel<?php echo e($school->id); ?>">Confirm School Approval</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <p class="mb-2">Unakaribia ku-approve shule hii. Tafadhali hakiki taarifa kabla ya kuendelea:</p>

                                                            <ul class="list-group">
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span>School Name</span>
                                                                    <strong><?php echo e($school->name); ?></strong>
                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span>Reg Number</span>
                                                                    <strong><?php echo e($school->registration_number); ?></strong>
                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span>Email</span>
                                                                    <strong><?php echo e($school->email); ?></strong>
                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span>Category</span>
                                                                    <strong><?php echo e($school->category); ?></strong>
                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span>Level</span>
                                                                    <strong><?php echo e($school->level); ?></strong>
                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span>Owner (User ID)</span>
                                                                    <strong><?php echo e($school->user_id); ?></strong>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                                                            <form action="<?php echo e(route('schools.quickApprove', $school)); ?>" method="POST">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('PATCH'); ?>
                                                                <button type="submit" class="btn btn-success">Approve Now</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-folder-open fa-3x mb-3"></i>
                                            <p>No schools found in the system.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix bg-white">
                    <?php echo e($schools->links()); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .card-success.card-outline {
            border-top: 3px solid #28a745;
        }
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #000;
        }
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
            color: #000;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\ZERIXA\WebApps\emas\resources\views/admin/schools/index.blade.php ENDPATH**/ ?>