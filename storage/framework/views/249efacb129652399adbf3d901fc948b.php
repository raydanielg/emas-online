<?php $__env->startSection('title', 'Assign Subjects to Teacher'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-success font-weight-bold mb-0">Assign Subjects to Teacher</h1>
        <a href="<?php echo e(route('user.teachers.index')); ?>" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left mr-1"></i> Back to List
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-white">
                    <h3 class="card-title text-dark font-weight-bold">
                        <i class="fas fa-user-tag mr-1 text-success"></i> Teachers & Their Subjects
                    </h3>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Teacher Name</th>
                                <th>Initials</th>
                                <th>Assigned Subjects (Click to Manage)</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="align-middle"><?php echo e($loop->iteration); ?></td>
                                    <td class="align-middle font-weight-bold"><?php echo e($teacher->name); ?></td>
                                    <td class="align-middle"><span class="badge badge-secondary"><?php echo e($teacher->initials); ?></span></td>
                                    <td class="align-middle">
                                        <?php $__empty_2 = true; $__currentLoopData = $teacher->assignments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assignment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                            <span class="badge badge-info mb-1 mr-1 p-2" style="font-size: 0.8rem;">
                                                <?php echo e($assignment->subject->name); ?> (<?php echo e($assignment->schoolClass->globalClass->name); ?>)
                                            </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                            <span class="text-muted small italic">Not assigned yet</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-right align-middle">
                                        <button type="button" class="btn btn-sm btn-primary shadow-sm" 
                                                onclick="openUnifiedAssignModal('<?php echo e($teacher->id); ?>', '<?php echo e($teacher->name); ?>')">
                                            <i class="fas fa-plus-circle mr-1"></i> Assign New
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted italic">No teachers found. Go to "All Teachers" to add some.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Unified Assignment Modal -->
    <div class="modal fade" id="unifiedAssignModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header bg-primary text-white border-0">
                    <h5 class="modal-title font-weight-bold"><i class="fas fa-link mr-2"></i>Assign Subject: <span id="targetTeacherName"></span></h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('user.subjects.teachers.assign')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="teacher_id" id="targetTeacherId">
                    <div class="modal-body py-4">
                        <div class="form-group mb-4">
                            <label class="small font-weight-bold">Step 1: Select Class</label>
                            <select id="modalClassSelect" class="form-control select2" style="width: 100%;" required>
                                <option value="">-- Choose Class --</option>
                                <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($class->id); ?>"><?php echo e($class->globalClass->name); ?> (<?php echo e($class->globalClass->level); ?>)</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group mb-0" id="modalSubjectContainer" style="display:none;">
                            <label class="small font-weight-bold">Step 2: Select Subject</label>
                            <select name="school_subject_id" id="modalSubjectSelect" class="form-control" required>
                                <option value="">-- Choose Subject --</option>
                            </select>
                        </div>
                        <div id="modalNoSubjectsAlert" class="text-danger small mt-2 text-center" style="display:none;">
                            <i class="fas fa-exclamation-circle mr-1"></i> No available subjects for this class.
                        </div>
                        <div id="modalLoadingSubjects" class="text-center mt-2" style="display:none;">
                            <i class="fas fa-spinner fa-spin text-primary"></i> Loading...
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-0">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ghairi</button>
                        <button type="submit" class="btn btn-primary font-weight-bold shadow-sm px-4">
                            Save Assignment
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
                dropdownParent: $('#unifiedAssignModal')
            });

            window.openUnifiedAssignModal = function(id, name) {
                $('#targetTeacherId').val(id);
                $('#targetTeacherName').text(name);
                $('#modalClassSelect').val('').trigger('change');
                $('#modalSubjectContainer').hide();
                $('#modalNoSubjectsAlert').hide();
                $('#unifiedAssignModal').modal('show');
            }

            $('#modalClassSelect').on('change', function() {
                const classId = $(this).val();
                if (!classId) return;

                $('#modalLoadingSubjects').show();
                $('#modalSubjectContainer').hide();
                $('#modalNoSubjectsAlert').hide();

                $.get("<?php echo e(route('user.subjects.teachers.class_subjects')); ?>", { class_id: classId }, function(data) {
                    $('#modalLoadingSubjects').hide();
                    const $select = $('#modalSubjectSelect');
                    $select.empty().append('<option value="">-- Choose Subject --</option>');
                    
                    if (data && data.length > 0) {
                        data.forEach(item => {
                            $select.append(`<option value="${item.id}">${item.subject_name}</option>`);
                        });
                        $('#modalSubjectContainer').show();
                    } else {
                        $('#modalNoSubjectsAlert').show();
                    }
                });
            });

            <?php if(session('success')): ?>
                Swal.fire({ title: 'Success', text: "<?php echo e(session('success')); ?>", icon: 'success', timer: 2000, showConfirmButton: false });
            <?php endif; ?>
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
        .select2-container--default .select2-selection--single { height: 38px !important; padding: 6px 12px; }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\ZERIXA\WebApps\emas\resources\views/user/teachers/assign_subjects.blade.php ENDPATH**/ ?>