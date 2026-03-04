@extends('adminlte::page')

@section('title', 'Student Profile')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-success font-weight-bold">Student Profile</h1>
        <div>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
            <a href="{{ route('students.edit', $student) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit Student
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-body box-profile text-center">
                    <div class="text-success mb-3">
                        <i class="fas fa-user-graduate fa-7x"></i>
                    </div>
                    <h3 class="profile-username text-center font-weight-bold">{{ $student->full_name }}</h3>
                    <p class="text-muted text-center">{{ $student->admission_number }}</p>

                    <ul class="list-group list-group-unbordered mb-3 text-left">
                        <li class="list-group-item">
                            <b>Status</b> 
                            <span class="float-right">
                                <span class="badge badge-{{ $student->status == 'Active' ? 'success' : 'secondary' }}">
                                    {{ $student->status }}
                                </span>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <b>Gender</b> <span class="float-right text-dark font-weight-bold">{{ $student->gender }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Class Level</b> <span class="float-right text-dark font-weight-bold">{{ $student->class_level }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Personal & School Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <strong><i class="fas fa-school mr-1 text-success"></i> Registered School</strong>
                            <p class="text-muted">{{ $student->school->name ?? 'N/A' }}</p>
                        </div>
                        <div class="col-sm-6">
                            <strong><i class="fas fa-calendar-alt mr-1 text-success"></i> Date of Birth</strong>
                            <p class="text-muted">{{ $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('d M, Y') : 'N/A' }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <strong><i class="fas fa-clock mr-1 text-success"></i> Registered At</strong>
                            <p class="text-muted">{{ $student->created_at->format('d M, Y H:i') }}</p>
                        </div>
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
