@extends('adminlte::page')

@section('title', 'Add New Student')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="text-success font-weight-bold mb-0">Add New Student</h1>
            <small class="text-muted">Register a student to your school</small>
        </div>
        <div>
            <a href="{{ route('user.students.index') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left mr-1"></i> Back
            </a>
        </div>
    </div>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Student Details</h3>
                </div>

                <form action="{{ route('user.students.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" class="form-control" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="middle_name">Middle Name (optional)</label>
                                <input type="text" name="middle_name" id="middle_name" value="{{ old('middle_name') }}" class="form-control">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="admission_number">Admission No</label>
                                <input type="text" name="admission_number" id="admission_number" value="{{ old('admission_number') }}" class="form-control" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="gender">Gender</label>
                                @php($selectedGender = old('gender'))
                                <select name="gender" id="gender" class="form-control" required>
                                    <option value="" {{ $selectedGender === null || $selectedGender === '' ? 'selected' : '' }}>Select</option>
                                    <option value="Male" {{ $selectedGender === 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $selectedGender === 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="class_level">Class</label>
                                <input type="text" name="class_level" id="class_level" value="{{ old('class_level') }}" class="form-control" placeholder="e.g. Form 1" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4 mb-0">
                                <label for="date_of_birth">Date of Birth (optional)</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success font-weight-bold">
                            <i class="fas fa-save mr-1"></i> Save Student
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Tips</h3>
                </div>
                <div class="card-body text-muted">
                    <div class="mb-2"><i class="fas fa-info-circle mr-1"></i> Admission number lazima iwe unique.</div>
                    <div class="mb-2"><i class="fas fa-info-circle mr-1"></i> DOB ukijaza, progress ya dashboard itaongezeka.</div>
                    <div><i class="fas fa-info-circle mr-1"></i> Class unaweza kuandika kwa style ya shule yenu.</div>
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
