@extends('adminlte::page')

@section('title', 'Teacher Assign Class')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-success font-weight-bold mb-0">Teacher Assign Class</h1>
        <div class="small text-muted">Assign Main Class Teacher (In-charge)</div>
    </div>
@stop

@section('content')
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
                            @forelse($classes as $class)
                                <tr>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle font-weight-bold text-dark">
                                        {{ $class->globalClass->name }}
                                    </td>
                                    <td class="align-middle">
                                        <span class="badge badge-secondary">{{ $class->globalClass->level }}</span>
                                    </td>
                                    <td class="align-middle">
                                        @if($class->teacher)
                                            <span class="text-primary font-weight-bold">
                                                <i class="fas fa-user-check mr-1"></i> {{ $class->teacher->name }}
                                            </span>
                                        @else
                                            <span class="text-muted small italic">No teacher assigned as in-charge</span>
                                        @endif
                                    </td>
                                    <td class="text-right align-middle">
                                        <button type="button" class="btn btn-sm btn-outline-primary shadow-sm" 
                                                onclick="openClassTeacherModal('{{ $class->id }}', '{{ $class->globalClass->name }}', '{{ $class->teacher_id }}')">
                                            <i class="fas fa-edit mr-1"></i> Assign Teacher
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted italic">No classes found for your school. Please import classes first.</td>
                                </tr>
                            @endforelse
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
                <form action="{{ route('user.teachers.assign_classes.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="school_class_id" id="modalClassId">
                    <div class="modal-body py-4 text-center">
                        <div class="form-group mb-0 text-left">
                            <label class="small font-weight-bold">Select Teacher In-charge</label>
                            <select name="teacher_id" id="modalTeacherSelect" class="form-control select2" style="width: 100%;" required>
                                <option value="">-- Choose Teacher --</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }} ({{ $teacher->initials }})</option>
                                @endforeach
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
@stop

@section('js')
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

            @if(session('success'))
                Swal.fire({ title: 'Success', text: "{{ session('success') }}", icon: 'success', timer: 2000, showConfirmButton: false });
            @endif
        });
    </script>
@stop

@section('css')
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
        .italic { font-style: italic; }
        .modal-sm { max-width: 350px; }
    </style>
@stop
