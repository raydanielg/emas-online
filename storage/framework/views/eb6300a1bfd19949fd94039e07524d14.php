<?php $__env->startSection('title', 'Edit School Info'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <h1 class="text-success font-weight-bold mb-0">Edit School Information</h1>
        <a href="<?php echo e(route('user.academic.school.info')); ?>" class="btn btn-secondary mt-2 mt-md-0">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
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
                <h3 class="card-title text-dark font-weight-bold mb-0"><i class="fas fa-edit mr-1"></i> Update Details</h3>
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

            <form action="<?php echo e(route('user.academic.school.update')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Jina la Shule</label>
                                <input type="text" name="name" id="name" class="form-control" value="<?php echo e(old('name', $school->name)); ?>" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="registration_number">Namba ya Usajili</label>
                                <input type="text" name="registration_number" id="registration_number" class="form-control" value="<?php echo e(old('registration_number', $school->registration_number)); ?>" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Barua pepe ya Shule</label>
                                <input type="email" name="email" id="email" class="form-control" value="<?php echo e(old('email', $school->email)); ?>" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Simu</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="<?php echo e(old('phone', $school->phone)); ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Anuani</label>
                                <input type="text" name="address" id="address" class="form-control" value="<?php echo e(old('address', $school->address)); ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category">Aina ya Shule</label>
                                <?php ($selectedCategory = old('category', $school->category)); ?>
                                <select name="category" id="category" class="form-control" required>
                                    <option value="Government" <?php echo e($selectedCategory === 'Government' ? 'selected' : ''); ?>>Government</option>
                                    <option value="Private" <?php echo e($selectedCategory === 'Private' ? 'selected' : ''); ?>>Private</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="level">Ngazi</label>
                                <?php ($selectedLevel = old('level', $school->level)); ?>
                                <select name="level" id="level" class="form-control" required>
                                    <option value="Primary" <?php echo e($selectedLevel === 'Primary' ? 'selected' : ''); ?>>Primary</option>
                                    <option value="Secondary" <?php echo e($selectedLevel === 'Secondary' ? 'selected' : ''); ?>>Secondary</option>
                                    <option value="O-Level" <?php echo e($selectedLevel === 'O-Level' ? 'selected' : ''); ?>>O-Level</option>
                                    <option value="A-Level" <?php echo e($selectedLevel === 'A-Level' ? 'selected' : ''); ?>>A-Level</option>
                                    <option value="Both" <?php echo e($selectedLevel === 'Both' ? 'selected' : ''); ?>>Both</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="description">Maelezo (hiari)</label>
                                <textarea name="description" id="description" class="form-control" rows="3"><?php echo e(old('description', $school->description)); ?></textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="logo">Logo (hiari)</label>
                                <input type="file" name="logo" id="logo" class="form-control-file">
                                <?php if($school->logo): ?>
                                    <div class="mt-2">
                                        <img src="<?php echo e(asset('storage/' . $school->logo)); ?>" width="60" class="img-circle" alt="School Logo">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <?php if($school->status === 'Approved'): ?>
                        <div class="alert alert-info mb-0">
                            Shule yako tayari iko <strong>Approved</strong>. Mabadiliko yoyote yanaweza kuhitaji uhakiki upya kulingana na sera za mfumo.
                        </div>
                    <?php endif; ?>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </div>
            </form>
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

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\ZERIXA\WebApps\emas\resources\views/user/academic/school-edit.blade.php ENDPATH**/ ?>