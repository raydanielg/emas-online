@extends('adminlte::page')

@section('title', 'Edit Student')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="text-success font-weight-bold mb-0">Edit Student</h1>
            <small class="text-muted">Update information for {{ $student->full_name }}</small>
        </div>
        <div>
            <a href="{{ route('user.students.manage') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left mr-1"></i> Back to Manage
            </a>
        </div>
    </div>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-white">
                    <h3 class="card-title text-dark">
                        <i class="fas fa-user-edit mr-1 text-success"></i> Edit Details
                    </h3>
                </div>

                <form action="{{ route('user.students.update', $student) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $student->first_name) }}" class="form-control" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="middle_name">Middle Name (optional)</label>
                                <input type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', $student->middle_name) }}" class="form-control">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $student->last_name) }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="admission_number">Admission No</label>
                                <input type="text" name="admission_number" id="admission_number" value="{{ old('admission_number', $student->admission_number) }}" class="form-control" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="gender">Gender</label>
                                @php($selectedGender = old('gender', $student->gender))
                                <select name="gender" id="gender" class="form-control" required>
                                    <option value="Male" {{ $selectedGender === 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $selectedGender === 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="class_level">Class</label>
                                <input type="text" name="class_level" id="class_level" value="{{ old('class_level', $student->class_level) }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('Y-m-d') : '') }}" class="form-control">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="status">Status</label>
                                @php($selectedStatus = old('status', $student->status))
                                <select name="status" id="status" class="form-control" required>
                                    <option value="Active" {{ $selectedStatus === 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Graduated" {{ $selectedStatus === 'Graduated' ? 'selected' : '' }}>Graduated</option>
                                    <option value="Transferred" {{ $selectedStatus === 'Transferred' ? 'selected' : '' }}>Transferred</option>
                                    <option value="Suspended" {{ $selectedStatus === 'Suspended' ? 'selected' : '' }}>Suspended</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white">
                        <button type="submit" class="btn btn-success font-weight-bold shadow-sm">
                            <i class="fas fa-save mr-1"></i> Update Student
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-white">
                    <h3 class="card-title text-dark">
                        <i class="fas fa-info-circle mr-1 text-success"></i> Information
                    </h3>
                </div>
                <div class="card-body">
                    <p class="text-muted small">Update student details carefully. Changing the status will affect how the student appears in lists and reports.</p>
                    <hr>
                    <div class="text-muted small">
                        <strong>Registered:</strong> {{ $student->created_at->format('d M Y') }}<br>
                        <strong>Last Updated:</strong> {{ $student->updated_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
    </style>
@stop
