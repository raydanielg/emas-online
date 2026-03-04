@extends('adminlte::page')

@section('title', 'Edit Student')

@section('content_header')
    <h1>Edit Student: {{ $student->full_name }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Update Student Information</h3>
                </div>
                <form action="{{ route('students.update', $student) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="first_name">First Name <span class="text-danger">*</span></label>
                                <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $student->first_name) }}" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" name="middle_name" class="form-control" value="{{ old('middle_name', $student->middle_name) }}">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $student->last_name) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="admission_number">Admission Number <span class="text-danger">*</span></label>
                                <input type="text" name="admission_number" class="form-control" value="{{ old('admission_number', $student->admission_number) }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="gender">Gender <span class="text-danger">*</span></label>
                                <select name="gender" class="form-control" required>
                                    <option value="Male" {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', $student->date_of_birth) }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="school_id">School <span class="text-danger">*</span></label>
                                <select name="school_id" class="form-control select2" required>
                                    @foreach($schools as $school)
                                        <option value="{{ $school->id }}" {{ old('school_id', $student->school_id) == $school->id ? 'selected' : '' }}>
                                            {{ $school->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="class_level">Class Level <span class="text-danger">*</span></label>
                                <input type="text" name="class_level" class="form-control" value="{{ old('class_level', $student->class_level) }}" placeholder="e.g. Form 1, Standard 1" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="status">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control" required>
                                    <option value="Active" {{ old('status', $student->status) == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Graduated" {{ old('status', $student->status) == 'Graduated' ? 'selected' : '' }}>Graduated</option>
                                    <option value="Transferred" {{ old('status', $student->status) == 'Transferred' ? 'selected' : '' }}>Transferred</option>
                                    <option value="Suspended" {{ old('status', $student->status) == 'Suspended' ? 'selected' : '' }}>Suspended</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-right">
                        <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-warning shadow-sm">Update Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@stop

@section('css')
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
    </style>
@stop
