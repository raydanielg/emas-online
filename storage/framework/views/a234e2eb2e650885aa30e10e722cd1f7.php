<?php $__env->startSection('title', 'Edit User'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Edit User: <?php echo e($user->name); ?></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Update User Information</h3>
                </div>
                <form action="<?php echo e(route('users.update', $user)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $user->name)); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" class="form-control" value="<?php echo e(old('email', $user->email)); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Assign Role</label>
                            <select name="role" class="form-control" required>
                                <option value="">Select Role</option>
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($role->name); ?>" <?php echo e(in_array($role->name, $userRoles) ? 'selected' : ''); ?>>
                                        <?php echo e(ucfirst($role->name)); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="school_id">Assign School (If not Admin)</label>
                            <select name="school_id" class="form-control select2">
                                <option value="">No School (Admin Only)</option>
                                <?php $__currentLoopData = $schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($school->id); ?>" <?php echo e($user->school_id == $school->id ? 'selected' : ''); ?>>
                                        <?php echo e($school->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="active" <?php echo e($user->status == 'active' ? 'selected' : ''); ?>>Active</option>
                                <option value="suspended" <?php echo e($user->status == 'suspended' ? 'selected' : ''); ?>>Suspended</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="password">Password (Leave blank to keep current)</label>
                                <input type="password" name="password" class="form-control" placeholder="New Password">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-right">
                        <a href="<?php echo e(route('users.index')); ?>" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-warning shadow-sm">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\ZERIXA\WebApps\emas\resources\views/admin/users/edit.blade.php ENDPATH**/ ?>