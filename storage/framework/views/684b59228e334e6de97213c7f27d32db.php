<?php $__env->startSection('title', 'School Info'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <h1 class="text-success font-weight-bold mb-0">School Information</h1>
        <?php if($school): ?>
            <a href="<?php echo e(route('user.academic.school.edit')); ?>" class="btn btn-warning mt-2 mt-md-0">
                <i class="fas fa-edit"></i> Edit School Info
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('warning')): ?>
        <div class="alert alert-warning">
            <?php echo e(session('warning')); ?>

        </div>
    <?php endif; ?>

    <?php if(!$school): ?>
        <div class="alert alert-warning">
            Tafadhali kamilisha usajili wa shule kwanza.
            <a href="<?php echo e(route('user.school.setup')); ?>" class="font-weight-bold">Jaza taarifa za shule</a>
        </div>
    <?php else: ?>
        <div class="card card-outline card-success shadow-sm">
            <div class="card-header bg-warning d-flex justify-content-between align-items-center flex-wrap">
                <h3 class="card-title text-dark font-weight-bold mb-0">
                    <i class="fas fa-school mr-1"></i> <?php echo e($school->name); ?>

                </h3>

                <div class="mt-2 mt-md-0">
                    <?php if($school->status === 'Approved'): ?>
                        <span class="badge badge-success p-2">Approved</span>
                    <?php elseif($school->status === 'Pending'): ?>
                        <span class="badge badge-warning text-dark p-2">Pending</span>
                    <?php else: ?>
                        <span class="badge badge-danger p-2">Rejected</span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-box bg-light">
                            <span class="info-box-icon bg-info"><i class="fas fa-id-card"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Registration Number</span>
                                <span class="info-box-number"><?php echo e($school->registration_number); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-box bg-light">
                            <span class="info-box-icon bg-success"><i class="fas fa-envelope"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">School Email</span>
                                <span class="info-box-number"><?php echo e($school->email); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-box bg-light">
                            <span class="info-box-icon bg-warning"><i class="fas fa-layer-group"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Category</span>
                                <span class="info-box-number"><?php echo e($school->category); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-box bg-light">
                            <span class="info-box-icon bg-danger"><i class="fas fa-graduation-cap"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Level</span>
                                <span class="info-box-number"><?php echo e($school->level); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Phone</label>
                            <div class="text-muted"><?php echo e($school->phone ?: '-'); ?></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Address</label>
                            <div class="text-muted"><?php echo e($school->address ?: '-'); ?></div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label>Description</label>
                            <div class="text-muted"><?php echo e($school->description ?: '-'); ?></div>
                        </div>
                    </div>
                </div>

                <?php if($school->status === 'Pending'): ?>
                    <div class="alert alert-warning mb-0">
                        Usajili wa shule yako bado upo <strong>Pending</strong>. Unaweza kuhariri taarifa, kisha subiri uthibitisho.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
        .btn-warning { background-color: #ffc107; border-color: #ffc107; color: #000; }
        .btn-warning:hover { background-color: #e0a800; border-color: #d39e00; color: #000; }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\ZERIXA\WebApps\emas\resources\views/user/academic/school-info.blade.php ENDPATH**/ ?>