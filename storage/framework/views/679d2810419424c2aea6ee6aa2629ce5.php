<?php $__env->startSection('title', 'Teacher Assign Class'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-success font-weight-bold mb-0">Teacher Assign Class</h1>
        <div class="small text-muted">Assign Main Class Teacher (In-charge)</div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-white">
                    <h3 class="card-title text-dark font-weight-bold">
                        <i class="fas fa-chalkboard-teacher mr-1 text-success"></i> Class Teachers Assignment
                    </h3>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Class Name</th>
                                <th>Level</th>
                                <th>Current Class Teacher</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="align-middle"><?php echo e($loop->iteration); ?></td>
                                    <td class="align-middle font-weight-bold text-dark">
                                        <?php echo e($class->globalClass->name); ?>

                                    </td>
                                    <td class="align-middle">
                                        <span class="badge badge-secondary"><?php echo e($class->globalClass->level); ?></span>
                                    </td>
                                    <td class="align-middle">
                                        <?php if($class->teacher): ?>
                                            <span class="text-primary font-weight-bold">
                                                <i class="fas fa-user-check mr-1"></i> <?php echo e($class->teacher->name); ?>

                                            </span>
                                        <?php else: ?>
                                            <span class="text-muted small italic">No teacher assigned as in-charge</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-right align-middle">
                                        <button type="button" class="btn btn-sm btn-outline-primary shadow-sm" 
                                                onclick="openClassTeacherModal('<?php echo e($class->id); ?>', '<?php echo e($class->globalClass->name); ?>', '<?php echo e($class->teacher_id); ?>')">
                                            <i class="fas fa-edit mr-1"></i> Assign Teacher
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted italic">No classes found for your school. Please import classes first.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Class Teacher Modal -->
    <div class="modal fade" id="classTeacherModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header bg-success text-white border-0 py-2">
                    <h6 class="modal-title font-weight-bold">Class Teacher: <span id="modalClassName"></span></h6>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('user.teachers.assign_classes.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="school_class_id" id="modalClassId">
                    <div class="modal-body py-4 text-center">
                        <div class="form-group mb-0 text-left">
                            <label class="small font-weight-bold">Select Teacher In-charge</label>
                            <select name="teacher_id" id="modalTeacherSelect" class="form-control select2" style="width: 100%;" required>
                                <option value="">-- Choose Teacher --</option>
                                <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($teacher->id); ?>"><?php echo e($teacher->name); ?> (<?php echo e($teacher->initials); ?>)</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <p class="text-muted small mt-3 italic">
                            Mwalimu huyu atakuwa msimamizi mkuu (Class Teacher) wa darasa hili.
                        </p>
                    </div>
                    <div class="modal-footer bg-light border-0 py-2">
                        <button type="submit" class="btn btn-success btn-sm btn-block font-weight-bold shadow-sm">
                            Save Class Teacher
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function () {
            $('.select2').select2({
                dropdownParent: $('#classTeacherModal')
            });

            window.openClassTeacherModal = function(classId, className, currentTeacherId) {
                $('#modalClassId').val(classId);
                $('#modalClassName').text(className);
                $('#modalTeacherSelect').val(currentTeacherId).trigger('change');
                $('#classTeacherModal').modal('show');
            }

            <?php if(session('success')): ?>
                Swal.fire({ title: 'Success', text: "<?php echo e(session('success')); ?>", icon: 'success', timer: 2000, showConfirmButton: false });
            <?php endif; ?>
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
        .italic { font-style: italic; }
        .modal-sm { max-width: 350px; }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\ZERIXA\WebApps\emas\resources\views/user/teachers/assign_classes.blade.php ENDPATH**/ ?>