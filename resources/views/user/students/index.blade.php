@extends('adminlte::page')

@section('title', 'My Students')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="text-success font-weight-bold mb-0">My Students</h1>
            <small class="text-muted">Students registered in your school</small>
        </div>
    </div>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $kpis['total'] ?? 0 }}</h3>
                    <p>Total Students</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $kpis['male'] ?? 0 }}</h3>
                    <p>Male</p>
                </div>
                <div class="icon">
                    <i class="fas fa-mars"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $kpis['female'] ?? 0 }}</h3>
                    <p>Female</p>
                </div>
                <div class="icon">
                    <i class="fas fa-venus"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $kpis['missing_dob'] ?? 0 }}</h3>
                    <p>Missing DOB</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-times"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Student List</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Admission No</th>
                                    <th>Full Name</th>
                                    <th>Gender</th>
                                    <th>Class</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($students as $student)
                                    <tr>
                                        <td><span class="badge badge-info shadow-sm">{{ $student->admission_number }}</span></td>
                                        <td>{{ $student->full_name }}</td>
                                        <td>{{ $student->gender }}</td>
                                        <td>{{ $student->class_level }}</td>
                                        <td>
                                            <span class="badge badge-{{ $student->status == 'Active' ? 'success' : 'secondary' }}">
                                                {{ $student->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <i class="fas fa-user-slash fa-3x mb-3"></i>
                                            <p class="mb-0">No students found for your school.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
        .bg-warning { background-color: #ffc107 !important; }
    </style>
@stop
