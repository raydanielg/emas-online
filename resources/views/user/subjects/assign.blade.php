@extends('adminlte::page')

@section('title', 'Assign Subjects')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="text-success font-weight-bold mb-0">Assign Subjects</h1>
            <small class="text-muted">Link subjects to specific classes in your school</small>
        </div>
        <div>
            <a href="{{ route('user.subjects.index') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left mr-1"></i> Back
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-white">
                    <h3 class="card-title text-dark font-weight-bold">
                        <i class="fas fa-link mr-1 text-success"></i> Assign Subjects to Class
                    </h3>
                </div>
                <form action="{{ route('user.subjects.assign.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="school_class_id">Select Class <span class="text-danger">*</span></label>
                                    <select name="school_class_id" id="school_class_id" class="form-control select2" required>
                                        <option value="">-- Choose Class --</option>
                                        @foreach($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->globalClass->name }} ({{ $class->globalClass->level }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="alert alert-info small mt-3">
                                    <i class="fas fa-info-circle mr-1"></i> Selecting a class will automatically load and show its currently assigned subjects for you to modify.
                                </div>
                            </div>
                            <div class="col-md-8 border-left">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <label class="mb-0">Select Subjects for this Class</label>
                                    <div class="btn-group">
                                        <button type="button" id="btnSelectAll" class="btn btn-xs btn-outline-secondary">Select All</button>
                                        <button type="button" id="btnDeselectAll" class="btn btn-xs btn-outline-secondary">Deselect All</button>
                                    </div>
                                </div>
                                <div class="row" id="subject-list-container">
                                    @if($subjects->isEmpty())
                                        <div class="col-12 text-center py-4">
                                            <p class="text-muted">No subjects imported yet. Please <a href="{{ route('user.subjects.import') }}">import subjects</a> first.</p>
                                        </div>
                                    @else
                                        @foreach($subjects->chunk(ceil($subjects->count() / 2)) as $chunk)
                                            <div class="col-md-6">
                                                @foreach($chunk as $subject)
                                                    <div class="custom-control custom-checkbox mb-2 subject-item-row">
                                                        <input class="custom-control-input subject-checkbox" type="checkbox" name="subject_ids[]" 
                                                               id="subject_{{ $subject->id }}" value="{{ $subject->id }}">
                                                        <label for="subject_{{ $subject->id }}" class="custom-control-label font-weight-normal">
                                                            <span class="badge badge-light border mr-1">{{ $subject->code }}</span> {{ $subject->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-right">
                        <button type="submit" class="btn btn-success font-weight-bold shadow-sm">
                            <i class="fas fa-save mr-1"></i> Save Assignments
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Summary Table Section -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card card-outline card-info shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title text-dark font-weight-bold">
                        <i class="fas fa-list mr-1 text-info"></i> Current Class-Subject Assignments
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-default btn-sm shadow-sm mr-2" id="btnPrint">
                            <i class="fas fa-print mr-1"></i> Print List
                        </button>
                    </div>
                </div>
                <div class="card-body border-bottom bg-light">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white border-right-0"><i class="fas fa-filter text-muted"></i></span>
                                </div>
                                <input type="text" id="tableFilter" class="form-control border-left-0" placeholder="Filter by Class or Subject...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0 table-responsive" id="printArea">
                    <table class="table table-sm table-hover table-striped mb-0" id="summaryTable">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 250px;">Class Name</th>
                                <th>Assigned Subjects</th>
                                <th class="text-center" style="width: 100px;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $classAssignments = $assignedSubjects->groupBy('school_class_id');
                            @endphp
                            @forelse($classes as $class)
                                @php
                                    $assigned = $classAssignments->get($class->id, collect());
                                @endphp
                                <tr class="assignment-row">
                                    <td class="font-weight-bold text-dark align-middle">
                                        {{ $class->globalClass->name }} ({{ $class->globalClass->level }})
                                    </td>
                                    <td class="align-middle">
                                        @forelse($assigned as $assignment)
                                            <span class="badge badge-info mb-1 mr-1 p-1 px-2 font-weight-normal assignment-badge" style="font-size: 0.85rem;">
                                                {{ $assignment->subject->name }}
                                                <a href="javascript:void(0)" 
                                                   onclick="removeSingleAssignment('{{ $assignment->id }}', '{{ $assignment->subject->name }}', '{{ $class->globalClass->name }}')"
                                                   class="text-white ml-1 badge-remove-link" title="Remove Subject">
                                                    <i class="fas fa-times-circle"></i>
                                                </a>
                                            </span>
                                        @empty
                                            <span class="text-muted small italic">No subjects assigned yet</span>
                                        @endforelse
                                    </td>
                                    <form id="remove-single-{{ $class->id }}" action="{{ route('user.subjects.assign.remove_single') }}" method="POST" style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="assignment_id" id="assignment_id_{{ $class->id }}">
                                    </form>
                                    <td class="text-center align-middle">
                                        <span class="badge badge-pill badge-secondary">{{ $assigned->count() }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted italic">No classes found for this school.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function () {
            $('.select2').select2();

            // Prepare assignments data as a simple mapping of "ClassID" -> [SubjectIDs]
            @php
                $formattedAssignments = $assignedSubjects->whereNotNull('school_class_id')
                    ->groupBy('school_class_id')
                    ->map(function($items) {
                        return $items->pluck('subject_id')->values();
                    })->toArray();
            @endphp
            const assignedData = @json($formattedAssignments);

            $('#school_class_id').on('change', function() {
                const classId = $(this).val();
                console.log('Selected Class ID:', classId);
                console.log('Available data:', assignedData);
                
                // Reset all checkboxes first
                $('.subject-checkbox').prop('checked', false);
                $('#btnSubmitForm').html('<i class="fas fa-save mr-1"></i> Save Assignments');
                
                if (classId && assignedData[classId]) {
                    console.log('Found subjects for class:', assignedData[classId]);
                    $('#btnSubmitForm').html('<i class="fas fa-sync-alt mr-1"></i> Update Assignments');
                    
                    const subjectIds = assignedData[classId];
                    subjectIds.forEach(function(subjectId) {
                        $(`#subject_${subjectId}`).prop('checked', true);
                    });
                }
            });

            // Select/Deselect All
            $('#btnSelectAll').on('click', function() {
                $('.subject-checkbox').prop('checked', true);
            });
            $('#btnDeselectAll').on('click', function() {
                $('.subject-checkbox').prop('checked', false);
            });

            // Table Filtering
            $('#tableFilter').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $("#summaryTable tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            // Print Functionality
            $('#btnPrint').on('click', function() {
                var printContents = document.getElementById('printArea').innerHTML;
                var originalContents = document.body.innerHTML;
                
                var header = `
                    <div style="text-align: center; margin-bottom: 20px;">
                        <h2>{{ auth()->user()->school->name ?? 'eMaS' }}</h2>
                        <h3>Class-Subject Assignment Report</h3>
                        <p>Date: ${new Date().toLocaleDateString()}</p>
                    </div>
                    <style>
                        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
                        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                        th { background-color: #f4f4f4; font-weight: bold; }
                        .badge { display: inline-block; padding: 2px 5px; border: 1px solid #ccc; border-radius: 3px; margin: 2px; font-size: 11px; }
                    </style>
                `;

                document.body.innerHTML = header + printContents;
                window.print();
                document.body.innerHTML = originalContents;
                location.reload(); // Reload to re-bind events
            });

            // Success Popup
            @if(session('success'))
                Swal.fire({
                    title: 'Imekamilika!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif
        });

        function removeSingleAssignment(assignmentId, subjectName, className) {
            Swal.fire({
                title: 'Ondoa Somo?',
                text: `Je, una uhakika unataka kuondoa somo la "${subjectName}" kwa darasa la "${className}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ndiyo, ondoa!',
                cancelButtonText: 'Ghairi'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Find the class ID from the parent row to use the correct form
                    // But wait, the route handles ID directly, let's use a generic form
                    document.getElementById('global-remove-id').value = assignmentId;
                    document.getElementById('global-remove-form').submit();
                }
            })
        }
    </script>

    <form id="global-remove-form" action="{{ route('user.subjects.assign.remove_single') }}" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
        <input type="hidden" name="assignment_id" id="global-remove-id">
    </form>
@stop

@section('css')
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
        .card-info.card-outline { border-top: 3px solid #17a2b8; }
        .custom-control-label { cursor: pointer; }
        .italic { font-style: italic; }
        .assignment-badge:hover { background-color: #138496 !important; }
        .badge-remove-link { opacity: 0.7; transition: opacity 0.2s; }
        .badge-remove-link:hover { opacity: 1; color: #ffcccc !important; }
        @media print {
            .no-print { display: none; }
        }
    </style>
@stop
