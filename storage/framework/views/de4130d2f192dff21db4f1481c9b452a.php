<?php $__env->startSection('title', 'Students Management'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between">
        <h1 class="text-success font-weight-bold">Students Management</h1>
        <div>
            <a href="<?php echo e(route('students.create')); ?>" class="btn btn-warning shadow-sm">
                <i class="fas fa-user-plus mr-1"></i> Add New Student
            </a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">System Students</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="bg-dark">
                            <tr>
                                <th>Admission No</th>
                                <th>Full Name</th>
                                <th>Gender</th>
                                <th>School</th>
                                <th>Level</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><span class="badge badge-info shadow-sm"><?php echo e($student->admission_number); ?></span></td>
                                    <td><?php echo e($student->full_name); ?></td>
                                    <td><?php echo e($student->gender); ?></td>
                                    <td><?php echo e($student->school->name ?? 'N/A'); ?></td>
                                    <td><?php echo e($student->class_level); ?></td>
                                    <td>
                                        <span class="badge badge-<?php echo e($student->status == 'Active' ? 'success' : 'secondary'); ?>">
                                            <?php echo e($student->status); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?php echo e(route('students.show', $student)); ?>" class="btn btn-sm btn-info" title="View"><i class="fas fa-eye"></i></a>
                                            <a href="<?php echo e(route('students.edit', $student)); ?>" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                            <form action="<?php echo e(route('students.destroy', $student)); ?>" method="POST" style="display:inline;" id="delete-student-<?php echo e($student->id); ?>">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('delete-student-<?php echo e($student->id); ?>')" title="Delete"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="fas fa-user-slash fa-3x mb-3"></i>
                                        <p>No students found in the system.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white">
                    <?php echo e($students->links()); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(formId) {
            Swal.fire({
                title: 'Je, una uhakika?',
                text: "Mwanafunzi huyu atafutwa kabisa kwenye mfumo!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ndiyo, futa!',
                cancelButtonText: 'Ghairi'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            })
        }
    </script>
<?php $__env->stopSection(); ?>
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
        .bg-warning { background-color: #ffc107 !important; }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\ZERIXA\WebApps\emas\resources\views/admin/students/index.blade.php ENDPATH**/ ?>