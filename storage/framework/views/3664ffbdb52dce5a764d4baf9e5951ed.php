<?php $__env->startSection('title', 'School Setup'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="text-success font-weight-bold">Kamilisha Taarifa za Shule</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('warning')): ?>
        <div class="alert alert-warning">
            <?php echo e(session('warning')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card card-outline card-success">
        <div class="card-header bg-warning">
            <h3 class="card-title text-dark font-weight-bold">Taarifa za Shule</h3>
        </div>

        <form action="<?php echo e(route('user.school.setup.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Jina la Shule</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?php echo e(old('name', $school->name ?? '')); ?>" required>
                </div>

                <div class="form-group">
                    <label for="registration_number">Namba ya Usajili</label>
                    <input type="text" name="registration_number" id="registration_number" class="form-control" value="<?php echo e(old('registration_number', $school->registration_number ?? '')); ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Barua pepe ya Shule</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?php echo e(old('email', $school->email ?? '')); ?>" required>
                </div>

                <div class="form-group">
                    <label for="phone">Simu</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="<?php echo e(old('phone', $school->phone ?? '')); ?>">
                </div>

                <div class="form-group">
                    <label for="address">Anuani</label>
                    <input type="text" name="address" id="address" class="form-control" value="<?php echo e(old('address', $school->address ?? '')); ?>">
                </div>

                <div class="form-group">
                    <label for="category">Aina ya Shule</label>
                    <select name="category" id="category" class="form-control" required>
                        <?php ($selectedCategory = old('category', $school->category ?? 'Government')); ?>
                        <option value="Government" <?php echo e($selectedCategory === 'Government' ? 'selected' : ''); ?>>Government</option>
                        <option value="Private" <?php echo e($selectedCategory === 'Private' ? 'selected' : ''); ?>>Private</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="level">Ngazi</label>
                    <?php ($selectedLevel = old('level', $school->level ?? 'O-Level')); ?>
                    <select name="level" id="level" class="form-control" required>
                        <option value="Primary" <?php echo e($selectedLevel === 'Primary' ? 'selected' : ''); ?>>Primary</option>
                        <option value="Secondary" <?php echo e($selectedLevel === 'Secondary' ? 'selected' : ''); ?>>Secondary</option>
                        <option value="O-Level" <?php echo e($selectedLevel === 'O-Level' ? 'selected' : ''); ?>>O-Level</option>
                        <option value="A-Level" <?php echo e($selectedLevel === 'A-Level' ? 'selected' : ''); ?>>A-Level</option>
                        <option value="Both" <?php echo e($selectedLevel === 'Both' ? 'selected' : ''); ?>>Both</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Maelezo (hiari)</label>
                    <textarea name="description" id="description" class="form-control" rows="3"><?php echo e(old('description', $school->description ?? '')); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="logo">Logo (hiari)</label>
                    <input type="file" name="logo" id="logo" class="form-control-file">
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success">Hifadhi na Endelea</button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\ZERIXA\WebApps\emas\resources\views/user/school/setup.blade.php ENDPATH**/ ?>