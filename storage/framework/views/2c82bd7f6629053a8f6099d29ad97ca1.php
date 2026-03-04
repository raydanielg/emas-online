<?php $__env->startSection('title', 'Edit School'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Edit School: <?php echo e($school->name); ?></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card card-success card-outline shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Update School Information</h3>
                </div>
                <form action="<?php echo e(route('schools.update', $school)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="name">School Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" id="name" value="<?php echo e(old('name', $school->name)); ?>" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="registration_number">Registration Number <span class="text-danger">*</span></label>
                                <input type="text" name="registration_number" class="form-control" id="registration_number" value="<?php echo e(old('registration_number', $school->registration_number)); ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="email">School Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" id="email" value="<?php echo e(old('email', $school->email)); ?>" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" name="phone" class="form-control" id="phone" value="<?php echo e(old('phone', $school->phone)); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" class="form-control" id="address" rows="2"><?php echo e(old('address', $school->address)); ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="category">Category</label>
                                <select name="category" class="form-control" id="category">
                                    <option value="Government" <?php echo e(old('category', $school->category) == 'Government' ? 'selected' : ''); ?>>Government</option>
                                    <option value="Private" <?php echo e(old('category', $school->category) == 'Private' ? 'selected' : ''); ?>>Private</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="level">Level</label>
                                <select name="level" class="form-control" id="level">
                                    <option value="Primary" <?php echo e(old('level', $school->level) == 'Primary' ? 'selected' : ''); ?>>Primary</option>
                                    <option value="Secondary" <?php echo e(old('level', $school->level) == 'Secondary' ? 'selected' : ''); ?>>Secondary</option>
                                    <option value="O-Level" <?php echo e(old('level', $school->level) == 'O-Level' ? 'selected' : ''); ?>>O-Level</option>
                                    <option value="A-Level" <?php echo e(old('level', $school->level) == 'A-Level' ? 'selected' : ''); ?>>A-Level</option>
                                    <option value="Both" <?php echo e(old('level', $school->level) == 'Both' ? 'selected' : ''); ?>>Both (O & A Level)</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="Pending" <?php echo e(old('status', $school->status) == 'Pending' ? 'selected' : ''); ?>>Pending</option>
                                    <option value="Approved" <?php echo e(old('status', $school->status) == 'Approved' ? 'selected' : ''); ?>>Approved</option>
                                    <option value="Rejected" <?php echo e(old('status', $school->status) == 'Rejected' ? 'selected' : ''); ?>>Rejected</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="logo">Update Logo (Optional)</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="logo" class="custom-file-input" id="logo">
                                    <label class="custom-file-label" for="logo">Choose new file</label>
                                </div>
                            </div>
                            <?php if($school->logo): ?>
                                <div class="mt-2 text-success">
                                    <i class="fas fa-image"></i> Current logo exists.
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="description">Brief Description</label>
                            <textarea name="description" class="form-control" id="description" rows="3"><?php echo e(old('description', $school->description)); ?></textarea>
                        </div>
                    </div>

                    <div class="card-footer bg-white text-right">
                        <a href="<?php echo e(route('schools.index')); ?>" class="btn btn-secondary mr-2">Cancel</a>
                        <button type="submit" class="btn btn-warning shadow-sm">
                            <i class="fas fa-save mr-1"></i> Update Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\ZERIXA\WebApps\emas\resources\views/admin/schools/edit.blade.php ENDPATH**/ ?>