<?php $__env->startSection('title', 'Add New User'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Add New User</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card card-outline card-success">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">User Information</h3>
                </div>
                <form action="<?php echo e(route('users.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter full name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Assign Role</label>
                            <select name="role" class="form-control" required>
                                <option value="">Select Role</option>
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($role->name); ?>"><?php echo e(ucfirst($role->name)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-right">
                        <a href="<?php echo e(route('users.index')); ?>" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-warning shadow-sm">Create User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\ZERIXA\WebApps\emas\resources\views/admin/users/create.blade.php ENDPATH**/ ?>