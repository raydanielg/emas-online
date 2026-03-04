<?php $__env->startSection('title', 'Add New Student'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Register New Student</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Student Registration Form</h3>
                </div>
                <form action="<?php echo e(route('students.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="first_name">First Name <span class="text-danger">*</span></label>
                                <input type="text" name="first_name" class="form-control" placeholder="Enter first name" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" name="middle_name" class="form-control" placeholder="Enter middle name">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                <input type="text" name="last_name" class="form-control" placeholder="Enter last name" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="admission_number">Admission Number <span class="text-danger">*</span></label>
                                <input type="text" name="admission_number" class="form-control" placeholder="e.g. ADM/2024/001" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="gender">Gender <span class="text-danger">*</span></label>
                                <select name="gender" class="form-control" required>
                                    <option value="">-- Select --</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" name="date_of_birth" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="school_id">School <span class="text-danger">*</span></label>
                                <select name="school_id" class="form-control select2" required>
                                    <option value="">-- Select School --</option>
                                    <?php $__currentLoopData = $schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($school->id); ?>"><?php echo e($school->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="class_level">Class Level <span class="text-danger">*</span></label>
                                <input type="text" name="class_level" class="form-control" placeholder="e.g. Form 1, Standard 1" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-right">
                        <a href="<?php echo e(route('students.index')); ?>" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-warning shadow-sm">Save Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\ZERIXA\WebApps\emas\resources\views/admin/students/create.blade.php ENDPATH**/ ?>