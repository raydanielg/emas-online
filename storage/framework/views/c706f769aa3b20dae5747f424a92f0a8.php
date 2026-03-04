<?php $__env->startSection('title', 'Add New Student'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="text-success font-weight-bold mb-0">Add New Student</h1>
            <small class="text-muted">Register a student to your school</small>
        </div>
        <div>
            <a href="<?php echo e(route('user.students.index')); ?>" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left mr-1"></i> Back
            </a>
        </div>
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

    <div class="row">
        <div class="col-lg-8">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Student Details</h3>
                </div>

                <form action="<?php echo e(route('user.students.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" id="first_name" value="<?php echo e(old('first_name')); ?>" class="form-control" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="middle_name">Middle Name (optional)</label>
                                <input type="text" name="middle_name" id="middle_name" value="<?php echo e(old('middle_name')); ?>" class="form-control">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" id="last_name" value="<?php echo e(old('last_name')); ?>" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="admission_number">Admission No</label>
                                <input type="text" name="admission_number" id="admission_number" value="<?php echo e(old('admission_number')); ?>" class="form-control" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="gender">Gender</label>
                                <?php ($selectedGender = old('gender')); ?>
                                <select name="gender" id="gender" class="form-control" required>
                                    <option value="" <?php echo e($selectedGender === null || $selectedGender === '' ? 'selected' : ''); ?>>Select</option>
                                    <option value="Male" <?php echo e($selectedGender === 'Male' ? 'selected' : ''); ?>>Male</option>
                                    <option value="Female" <?php echo e($selectedGender === 'Female' ? 'selected' : ''); ?>>Female</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="class_level">Class</label>
                                <input type="text" name="class_level" id="class_level" value="<?php echo e(old('class_level')); ?>" class="form-control" placeholder="e.g. Form 1" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4 mb-0">
                                <label for="date_of_birth">Date of Birth (optional)</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" value="<?php echo e(old('date_of_birth')); ?>" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success font-weight-bold">
                            <i class="fas fa-save mr-1"></i> Save Student
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Tips</h3>
                </div>
                <div class="card-body text-muted">
                    <div class="mb-2"><i class="fas fa-info-circle mr-1"></i> Admission number lazima iwe unique.</div>
                    <div class="mb-2"><i class="fas fa-info-circle mr-1"></i> DOB ukijaza, progress ya dashboard itaongezeka.</div>
                    <div><i class="fas fa-info-circle mr-1"></i> Class unaweza kuandika kwa style ya shule yenu.</div>
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

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\ZERIXA\WebApps\emas\resources\views/user/students/create.blade.php ENDPATH**/ ?>