@extends('adminlte::page')

@section('title', 'Students Management')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-success font-weight-bold">Students Management</h1>
        <div>
            <a href="{{ route('students.create') }}" class="btn btn-warning shadow-sm">
                <i class="fas fa-user-plus mr-1"></i> Add New Student
            </a>
        </div>
    </div>
@stop

@section('content')
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
                            @forelse($students as $student)
                                <tr>
                                    <td><span class="badge badge-info shadow-sm">{{ $student->admission_number }}</span></td>
                                    <td>{{ $student->full_name }}</td>
                                    <td>{{ $student->gender }}</td>
                                    <td>{{ $student->school->name ?? 'N/A' }}</td>
                                    <td>{{ $student->class_level }}</td>
                                    <td>
                                        <span class="badge badge-{{ $student->status == 'Active' ? 'success' : 'secondary' }}">
                                            {{ $student->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-info" title="View"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline;" id="delete-student-{{ $student->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('delete-student-{{ $student->id }}')" title="Delete"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="fas fa-user-slash fa-3x mb-3"></i>
                                        <p>No students found in the system.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white">
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
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
@stop
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
        .bg-warning { background-color: #ffc107 !important; }
    </style>
@stop
