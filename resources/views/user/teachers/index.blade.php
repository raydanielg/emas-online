@extends('adminlte::page')

@section('title', 'Subject Teachers')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-dark" style="font-weight: 400;">Teachers</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Teachers</li>
            </ol>
        </nav>
    </div>
@stop

@section('content')
    <div class="card shadow-sm border-0" style="background-color: #f4f6f9;">
        <div class="card-header bg-white border-0 py-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <form method="GET" action="{{ route('user.subjects.teachers.index') }}" class="input-group input-group-sm" style="max-width: 400px;">
                        <input type="text" name="q" value="{{ request('q') }}" class="form-control border-right-0" placeholder="Search teacher...">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default border-left-0">Search</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 text-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-sm font-weight-bold px-3 mr-1" data-toggle="modal" data-target="#addTeacherModal">
                            <i class="fas fa-plus-circle mr-1"></i> Quick Add Teacher
                        </button>
                        <button type="button" class="btn btn-default btn-sm font-weight-bold px-3 mr-1" id="btnExportExcel">Excel</button>
                        <button type="button" class="btn btn-default btn-sm font-weight-bold px-3" id="btnPrint">Print Out</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="teachersTable">
                    <thead style="background-color: #e9ecef; border-top: 2px solid #dee2e6;">
                        <tr>
                            <th style="width: 40px;" class="pl-4">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkAll">
                                    <label class="custom-control-label font-weight-bold" for="checkAll">All</label>
                                </div>
                            </th>
                            <th class="text-primary border-0 text-sm">Initials <i class="fas fa-sort small ml-1"></i></th>
                            <th class="text-primary border-0 text-sm">Full Name <i class="fas fa-sort small ml-1"></i></th>
                            <th class="text-primary border-0 text-sm">Phone <i class="fas fa-sort small ml-1"></i></th>
                            <th class="text-primary border-0 text-sm">Assignments <i class="fas fa-sort small ml-1"></i></th>
                            <th class="text-right pr-4 border-0 text-sm">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @forelse($teachers as $teacher)
                            <tr class="teacher-row">
                                <td class="pl-4 align-middle">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input teacher-checkbox" id="check_{{ $teacher->id }}">
                                        <label class="custom-control-label" for="check_{{ $teacher->id }}"></label>
                                    </div>
                                </td>
                                <td class="align-middle"><span class="badge badge-secondary p-2">{{ $teacher->initials }}</span></td>
                                <td class="align-middle font-weight-bold" style="color: #444;">{{ strtoupper($teacher->name) }}</td>
                                <td class="align-middle">{{ $teacher->phone ?? '-' }}</td>
                                <td class="align-middle">
                                    @forelse($teacher->assignments as $assignment)
                                        <span class="badge badge-info mb-1" style="font-weight: 500; font-size: 0.7rem;">
                                            {{ $assignment->subject->name }} ({{ $assignment->schoolClass->globalClass->name }})
                                        </span>
                                    @empty
                                        <span class="text-muted small italic">None</span>
                                    @endforelse
                                </td>
                                <td class="text-right pr-4 align-middle">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-link text-primary p-0 mr-2" 
                                                onclick="openAssignStepModal('{{ $teacher->id }}', '{{ $teacher->name }}')" 
                                                title="Assign Subject to Teacher">
                                            <i class="fas fa-link"></i>
                                        </button>
                                        <form action="{{ route('user.subjects.teachers.destroy', $teacher) }}" method="POST" class="d-inline" onsubmit="return confirm('Futa mwalimu huyu?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-link text-danger p-0">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fas fa-user-tie fa-3x mb-3 opacity-20"></i>
                                    <p class="mb-0">No teachers found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card-footer bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="small text-muted">
                    Showing {{ $teachers->firstItem() ?? 0 }} to {{ $teachers->lastItem() ?? 0 }} of {{ $teachers->total() }}
                </div>
                <div>
                    {{ $teachers->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Add Teacher Modal (Steps) -->
    <div class="modal fade" id="addTeacherModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header bg-success text-white border-0 py-2">
                    <h5 class="modal-title font-weight-bold"><i class="fas fa-user-plus mr-2"></i> Quick Add Teacher</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body p-0">
                    <div class="d-flex justify-content-around bg-light py-3 border-bottom mb-3">
                        <div class="step-item text-center" id="step1-indicator">
                            <span class="badge badge-primary rounded-circle" style="width: 25px; height: 25px; line-height: 18px;">1</span>
                            <div class="small font-weight-bold">Teacher Details</div>
                        </div>
                        <div class="step-item text-center opacity-50" id="step2-indicator">
                            <span class="badge badge-secondary rounded-circle" style="width: 25px; height: 25px; line-height: 18px;">2</span>
                            <div class="small">Confirm & Save</div>
                        </div>
                    </div>

                    <form action="{{ route('user.subjects.teachers.store') }}" method="POST" id="quickAddTeacherForm" class="px-4 pb-4">
                        @csrf
                        <div id="step1-content">
                            <div class="form-group mb-3">
                                <label class="small font-weight-bold">Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="teacher_name" class="form-control" placeholder="e.g. Ezra Daniel Gyunda" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="small font-weight-bold">Phone Number</label>
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="e.g. 0712345678">
                            </div>
                            <div class="form-group mb-0">
                                <label class="small font-weight-bold">Initials</label>
                                <input type="text" name="initials" id="teacher_initials" class="form-control" placeholder="e.g. EDG">
                                <small class="text-muted italic">Inatengenezwa automatically unapoandika jina.</small>
                            </div>
                        </div>

                        <div id="step2-content" style="display:none;">
                            <div class="alert alert-info border-0 shadow-sm">
                                <h6 class="font-weight-bold mb-3"><i class="fas fa-check-circle mr-1"></i> Hakiki Taarifa za Mwalimu:</h6>
                                <div class="mb-2"><strong>Jina:</strong> <span id="confirm-name" class="text-uppercase ml-1"></span></div>
                                <div class="mb-2"><strong>Simu:</strong> <span id="confirm-phone" class="ml-1"></span></div>
                                <div><strong>Initials:</strong> <span id="confirm-initials" class="badge badge-secondary ml-1 px-2 py-1"></span></div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer bg-light border-0 py-3">
                    <button type="button" class="btn btn-secondary btn-sm px-3" id="btnPrevStep" style="display:none;">Back</button>
                    <button type="button" class="btn btn-primary btn-sm px-4 font-weight-bold" id="btnNextStep">Next <i class="fas fa-arrow-right ml-1"></i></button>
                    <button type="button" class="btn btn-success btn-sm px-4 font-weight-bold shadow-sm" id="btnSubmitForm" style="display:none;">
                        <i class="fas fa-save mr-1"></i> Save Teacher
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Assign Subject Step Modal -->
    <div class="modal fade" id="assignStepModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header bg-primary text-white border-0 py-2">
                    <h5 class="modal-title font-weight-bold"><i class="fas fa-link mr-2"></i>Assign: <span id="assignTeacherName"></span></h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body p-0">
                    <div class="d-flex justify-content-around bg-light py-3 border-bottom mb-3">
                        <div class="step-item text-center" id="assign-step1-indicator">
                            <span class="badge badge-primary rounded-circle" style="width: 25px; height: 25px; line-height: 18px;">1</span>
                            <div class="small font-weight-bold">Select Classes</div>
                        </div>
                        <div class="step-item text-center opacity-50" id="assign-step2-indicator">
                            <span class="badge badge-secondary rounded-circle" style="width: 25px; height: 25px; line-height: 18px;">2</span>
                            <div class="small font-weight-bold">Select Subjects</div>
                        </div>
                    </div>

                    <form action="{{ route('user.teachers.assign_subjects.store') }}" method="POST" id="assignTeacherForm" class="px-4 pb-4">
                        @csrf
                        <input type="hidden" name="teacher_id" id="assignTeacherId">
                        
                        <div id="assign-step1-content">
                            <label class="small font-weight-bold mb-2">Chagua Madarasa (Checkbox List):</label>
                            <div class="border rounded p-3 bg-white" style="max-height: 250px; overflow-y: auto;">
                                @foreach($classes as $class)
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input type="checkbox" name="school_class_ids[]" value="{{ $class->id }}" class="custom-control-input class-selector" id="assign_class_{{ $class->id }}">
                                        <label class="custom-control-label font-weight-normal" for="assign_class_{{ $class->id }}">
                                            {{ $class->globalClass->name }} ({{ $class->globalClass->level }})
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div id="assign-step2-content" style="display:none;">
                            <label class="small font-weight-bold mb-2">Chagua Masomo:</label>
                            <div id="assignSubjectList" class="border rounded p-3 bg-white" style="max-height: 250px; overflow-y: auto;">
                                <!-- Subjects loaded via AJAX -->
                            </div>
                            <div id="assignLoadingSubjects" class="text-center mt-2" style="display:none;">
                                <i class="fas fa-spinner fa-spin text-primary"></i> Loading subjects...
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer bg-light border-0 py-3">
                    <button type="button" class="btn btn-secondary btn-sm px-3" id="btnAssignPrev" style="display:none;">Back</button>
                    <button type="button" class="btn btn-primary btn-sm px-4 font-weight-bold" id="btnAssignNext">Next <i class="fas fa-arrow-right ml-1"></i></button>
                    <button type="button" class="btn btn-success btn-sm px-4 font-weight-bold shadow-sm" id="btnAssignSubmit" style="display:none;">
                        <i class="fas fa-save mr-1"></i> Save Assignments
                    </button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .table thead th { text-transform: none; font-size: 0.85rem; font-weight: 600; padding: 12px 8px; }
        .teacher-row:nth-child(even) { background-color: #f8f9fa; }
        .teacher-row:hover { background-color: #f1f3f5 !important; }
        .breadcrumb-item + .breadcrumb-item::before { content: "/"; }
        .text-primary { color: #0056b3 !important; }
        .custom-control-label { cursor: pointer; }
        .table td { border-top: 1px solid #dee2e6; padding: 12px 8px; }
        .opacity-50 { opacity: 0.5; }
        .italic { font-style: italic; }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script>
        $(function () {
            // --- Quick Add Steps ---
            $('#btnNextStep').on('click', function() {
                const name = $('#teacher_name').val().trim();
                if (name === '') { Swal.fire('Onyo', 'Tafadhali jaza jina la mwalimu.', 'warning'); return; }
                $('#confirm-name').text(name);
                $('#confirm-phone').text($('#phone').val() || 'N/A');
                $('#confirm-initials').text($('#teacher_initials').val() || $('#teacher_initials').attr('placeholder') || 'N/A');
                $('#step1-content').hide(); $('#step2-content').show();
                $(this).hide(); $('#btnPrevStep').show(); $('#btnSubmitForm').show();
                $('#step1-indicator').addClass('opacity-50').find('.badge').removeClass('badge-primary').addClass('badge-secondary');
                $('#step2-indicator').removeClass('opacity-50').find('.badge').removeClass('badge-secondary').addClass('badge-primary');
            });
            $('#btnPrevStep').on('click', function() {
                $('#step2-content').hide(); $('#step1-content').show();
                $(this).hide(); $('#btnSubmitForm').hide(); $('#btnNextStep').show();
                $('#step2-indicator').addClass('opacity-50').find('.badge').removeClass('badge-primary').addClass('badge-secondary');
                $('#step1-indicator').removeClass('opacity-50').find('.badge').removeClass('badge-secondary').addClass('badge-primary');
            });
            $('#btnSubmitForm').on('click', function() {
                const $form = $('#quickAddTeacherForm');
                const $btn = $(this); $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Saving...');
                $.post($form.attr('action'), $form.serialize(), function(r) {
                    if (r.success) { Swal.fire({ title: 'Success', text: r.message, icon: 'success', timer: 2000, showConfirmButton: false }).then(() => location.reload()); }
                }).fail(function(x) { $btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Save Teacher'); Swal.fire('Error', 'Failed to save teacher.', 'error'); });
            });

            // --- Assign Steps ---
            window.openAssignStepModal = function(id, name) {
                $('#assignTeacherId').val(id); $('#assignTeacherName').text(name);
                $('.class-selector').prop('checked', false);
                $('#assign-step1-content').show(); $('#assign-step2-content').hide();
                $('#btnAssignNext').show(); $('#btnAssignPrev').hide(); $('#btnAssignSubmit').hide();
                $('#assign-step1-indicator .badge').addClass('badge-primary').removeClass('badge-secondary');
                $('#assign-step2-indicator').addClass('opacity-50').find('.badge').addClass('badge-secondary').removeClass('badge-primary');
                $('#assignStepModal').modal('show');
            };
            $('#btnAssignNext').on('click', function() {
                const ids = []; $('.class-selector:checked').each(function() { ids.push($(this).val()); });
                if (ids.length === 0) { Swal.fire('Onyo', 'Chagua darasa.', 'warning'); return; }
                $('#assignLoadingSubjects').show(); $('#assignSubjectList').hide();
                $.get("{{ route('user.subjects.teachers.class_subjects') }}", { class_id: ids }, function(data) {
                    $('#assignLoadingSubjects').hide(); const $l = $('#assignSubjectList'); $l.empty();
                    if (data.length > 0) {
                        data.forEach(i => { $l.append(`<div class="custom-control custom-checkbox mb-2"><input type="checkbox" name="school_subject_ids[]" value="${i.id}" class="custom-control-input" id="as_${i.id}"><label class="custom-control-label font-weight-normal" for="as_${i.id}">${i.subject_name}</label></div>`); });
                        $l.show();
                    }
                });
                $('#assign-step1-content').hide(); $('#assign-step2-content').show();
                $(this).hide(); $('#btnAssignPrev').show(); $('#btnAssignSubmit').show();
                $('#assign-step1-indicator').addClass('opacity-50').find('.badge').removeClass('badge-primary').addClass('badge-secondary');
                $('#assign-step2-indicator').removeClass('opacity-50').find('.badge').removeClass('badge-secondary').addClass('badge-primary');
            });
            $('#btnAssignPrev').on('click', function() {
                $('#assign-step2-content').hide(); $('#assign-step1-content').show();
                $(this).hide(); $('#btnAssignSubmit').hide(); $('#btnAssignNext').show();
                $('#assign-step2-indicator').addClass('opacity-50').find('.badge').removeClass('badge-primary').addClass('badge-secondary');
                $('#assign-step1-indicator').removeClass('opacity-50').find('.badge').removeClass('badge-secondary').addClass('badge-primary');
            });
            $('#btnAssignSubmit').on('click', function() {
                if ($('input[name="school_subject_ids[]"]:checked').length === 0) { Swal.fire('Onyo', 'Chagua somo.', 'warning'); return; }
                $('#assignTeacherForm').submit();
            });

            // --- Auto-initials ---
            $('#teacher_name').on('input', function() {
                if ($('#teacher_initials').val() === '') {
                    var w = $(this).val().trim().split(/\s+/); var i = '';
                    w.forEach(x => { if(x.length > 0) i += x[0].toUpperCase(); });
                    $('#teacher_initials').attr('placeholder', i);
                }
            });
            $('#checkAll').on('click', function() { $('.teacher-checkbox').prop('checked', this.checked); });
            $('#btnPrint').on('click', function() { window.print(); });
            $('#btnExportExcel').on('click', function() { var wb = XLSX.utils.table_to_book(document.getElementById("teachersTable"), {sheet: "Teachers"}); XLSX.writeFile(wb, "Teachers_List.xlsx"); });
        });
    </script>
@stop
