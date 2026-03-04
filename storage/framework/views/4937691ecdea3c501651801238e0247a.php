<?php $__env->startSection('title', 'Subject Teachers'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-success font-weight-bold mb-0">Subject Teachers</h1>
        <div class="d-flex">
            <button type="button" class="btn btn-success btn-sm shadow-sm mr-2" data-toggle="modal" data-target="#addTeacherModal">
                <i class="fas fa-plus-circle mr-1"></i> Quick Add Teacher
            </button>
            <button type="button" class="btn btn-default btn-sm shadow-sm mr-2" id="btnExportExcel">
                <i class="fas fa-file-excel mr-1 text-success"></i> Excel
            </button>
            <button type="button" class="btn btn-default btn-sm shadow-sm" id="btnExportPDF">
                <i class="fas fa-file-pdf mr-1 text-danger"></i> PDF
            </button>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <form method="GET" action="<?php echo e(route('user.subjects.teachers.index')); ?>" class="input-group input-group-sm" style="max-width: 400px;">
                                <input type="text" name="q" value="<?php echo e(request('q')); ?>" class="form-control border-right-0" placeholder="Search teacher...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default border-left-0">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="table table-sm table-hover mb-0" id="teachersTable">
                        <thead class="bg-light">
                            <tr>
                                <th style="width: 40px;" class="pl-4">#</th>
                                <th>Name</th>
                                <th style="width: 100px;">Initials</th>
                                <th>Assignments</th>
                                <th class="text-right pr-4" style="width: 100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="pl-4 align-middle text-muted text-sm"><?php echo e(($teachers->currentPage()-1) * $teachers->perPage() + $loop->iteration); ?></td>
                                    <td class="align-middle">
                                        <div class="font-weight-bold text-sm text-dark"><?php echo e($teacher->name); ?></div>
                                        <div class="small text-muted text-xs"><?php echo e($teacher->phone ?? ''); ?></div>
                                    </td>
                                    <td class="align-middle"><span class="badge badge-secondary"><?php echo e($teacher->initials); ?></span></td>
                                    <td class="align-middle">
                                        <?php $__empty_2 = true; $__currentLoopData = $teacher->assignments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assignment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                            <span class="badge badge-info mb-1" style="font-weight: 500; font-size: 0.7rem;">
                                                <?php echo e($assignment->subject->name); ?> (<?php echo e($assignment->schoolClass->globalClass->name); ?>)
                                            </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                            <span class="text-muted small italic">None</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-right pr-4 align-middle">
                                        <form action="<?php echo e(route('user.subjects.teachers.destroy', $teacher)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Futa mwalimu huyu?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted italic text-sm">No teachers found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white py-2 border-top">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="small text-muted">Total: <?php echo e($teachers->total()); ?></span>
                        <?php echo e($teachers->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Teacher Modal -->
    <div class="modal fade" id="addTeacherModal" tabindex="-1" role="dialog" aria-labelledby="addTeacherModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header bg-success text-white border-0">
                    <h5 class="modal-title font-weight-bold" id="addTeacherModalLabel"><i class="fas fa-user-plus mr-2"></i> Quick Add Teacher</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('user.subjects.teachers.store')); ?>" method="POST" id="quickAddTeacherForm">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body py-4">
                        <div class="form-group mb-3">
                            <label class="small font-weight-bold">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="teacher_name" class="form-control" placeholder="e.g. Ezra Daniel Gyunda" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="small font-weight-bold">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="e.g. 0712345678">
                        </div>
                        <div class="form-group mb-3">
                            <label class="small font-weight-bold">Initials</label>
                            <input type="text" name="initials" id="teacher_initials" class="form-control" placeholder="e.g. EDG">
                        </div>

                        <hr>
                        <div class="text-primary small mb-3 font-weight-bold"><i class="fas fa-link mr-1"></i> Assignment (Required)</div>

                        <div class="form-group mb-3">
                            <label class="small font-weight-bold">Select Classes <span class="text-danger">*</span></label>
                            <select name="school_class_ids[]" id="formClassSelect" class="form-control select2" multiple="multiple" data-placeholder="Choose Classes" style="width: 100%;" required>
                                <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($class->id); ?>"><?php echo e($class->globalClass->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group mb-0" id="formSubjectContainer" style="display:none;">
                            <label class="small font-weight-bold">Select Subjects <span class="text-danger">*</span></label>
                            <div id="subjectList" class="p-2 border rounded bg-light" style="max-height: 200px; overflow-y: auto;">
                                <!-- Subjects loaded via AJAX -->
                            </div>
                        </div>
                        <div id="formNoSubjectsAlert" class="text-danger small mt-2 text-center" style="display:none;">
                            <i class="fas fa-exclamation-circle mr-1"></i> No subjects found for selected classes.
                        </div>
                        <div id="formLoadingSubjects" class="text-center mt-2" style="display:none;">
                            <i class="fas fa-spinner fa-spin text-primary"></i>
                        </div>
                    </div>
                    <div class="modal-footer bg-light py-2 border-0">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" id="btnSaveTeacher" class="btn btn-success btn-sm font-weight-bold shadow-sm px-4">
                            <i class="fas fa-save mr-1"></i> Save Teacher
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>

    <script>
        $(function () {
            // Initialize Select2 Multiple
            $('#formClassSelect').select2({
                placeholder: "Choose Classes",
                dropdownParent: $('#addTeacherModal')
            });

            // Dynamic Subject Loading
            $('#formClassSelect').on('change', function() {
                const classIds = $(this).val();
                if (!classIds || classIds.length === 0) {
                    $('#formSubjectContainer').hide();
                    $('#formNoSubjectsAlert').hide();
                    $('#subjectList').empty();
                    return;
                }

                $('#formLoadingSubjects').show();
                $('#formSubjectContainer').hide();
                $('#formNoSubjectsAlert').hide();

                $.get("<?php echo e(route('user.subjects.teachers.class_subjects')); ?>", { class_id: classIds }, function(data) {
                    $('#formLoadingSubjects').hide();
                    const $list = $('#subjectList');
                    $list.empty();
                    
                    if (data && data.length > 0) {
                        data.forEach(item => {
                            $list.append(`
                                <div class="custom-control custom-checkbox mb-1">
                                    <input type="checkbox" name="school_subject_ids[]" value="${item.id}" class="custom-control-input" id="sub_${item.id}">
                                    <label class="custom-control-label small font-weight-normal" for="sub_${item.id}">${item.subject_name}</label>
                                </div>
                            `);
                        });
                        $('#formSubjectContainer').show();
                    } else {
                        $('#formNoSubjectsAlert').show();
                    }
                }).fail(function() {
                    $('#formLoadingSubjects').hide();
                    Swal.fire('Error', 'Failed to load subjects', 'error');
                });
            });

            // AJAX Form Submission
            $('#quickAddTeacherForm').on('submit', function(e) {
                e.preventDefault();
                
                const $form = $(this);
                const $btn = $('#btnSaveTeacher');
                const originalBtnHtml = $btn.html();

                if ($('#formSubjectContainer').is(':visible') && $('input[name="school_subject_ids[]"]:checked').length === 0) {
                    Swal.fire('Onyo', 'Tafadhali chagua angalau somo moja.', 'warning');
                    return;
                }
                
                $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Saving...');
                
                $.ajax({
                    url: $form.attr('action'),
                    method: 'POST',
                    data: $form.serialize(),
                    success: function(response) {
                        if (response.success) {
                            $('#addTeacherModal').modal('hide');
                            Swal.fire({ 
                                title: 'Success', 
                                text: response.message, 
                                icon: 'success', 
                                timer: 2000, 
                                showConfirmButton: false 
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    error: function(xhr) {
                        $btn.prop('disabled', false).html(originalBtnHtml);
                        let errorMsg = 'Failed to save teacher.';
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            errorMsg = Object.values(errors).flat().join('\n');
                        }
                        Swal.fire('Error', errorMsg, 'error');
                    }
                });
            });

            // Auto-initials
            $('#teacher_name').on('input', function() {
                if ($('#teacher_initials').val() === '') {
                    var words = $(this).val().trim().split(/\s+/);
                    var initials = '';
                    words.forEach(w => { if(w.length > 0) initials += w[0].toUpperCase(); });
                    $('#teacher_initials').attr('placeholder', initials);
                }
            });

            // Export Excel
            $('#btnExportExcel').on('click', function() {
                var wb = XLSX.utils.table_to_book(document.getElementById("teachersTable"), {sheet: "Teachers"});
                XLSX.writeFile(wb, "Teachers_List.xlsx");
            });

            // Export PDF
            $('#btnExportPDF').on('click', function() {
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();
                doc.text("Subject Teachers List", 14, 15);
                doc.autoTable({ 
                    html: '#teachersTable', 
                    startY: 20,
                    columns: [0, 1, 2, 3]
                });
                doc.save("Teachers_List.pdf");
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
        .card-info.card-outline { border-top: 3px solid #17a2b8; }
        .select2-container--default .select2-selection--multiple { min-height: 31px !important; font-size: 0.875rem !important; border: 1px solid #ced4da !important; }
        .italic { font-style: italic; }
        #subjectList::-webkit-scrollbar { width: 5px; }
        #subjectList::-webkit-scrollbar-thumb { background: #ccc; border-radius: 10px; }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\ZERIXA\WebApps\emas\resources\views/user/subjects/teachers.blade.php ENDPATH**/ ?>