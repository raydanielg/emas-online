@extends('adminlte::page')

@section('title', 'Result Details')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-success font-weight-bold">Academic Result Details</h1>
        <div>
            <a href="{{ route('results.index') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left mr-1"></i> Back
            </a>
            <a href="{{ route('results.edit', $result) }}" class="btn btn-warning shadow-sm">
                <i class="fas fa-edit mr-1"></i> Edit Result
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Performance Summary</h3>
                </div>
                <div class="card-body text-center">
                    <div class="display-1 font-weight-bold text-success">{{ $result->score }}%</div>
                    <h2 class="font-weight-bold mt-2">Grade: <span class="text-{{ $result->grade == 'F' ? 'danger' : 'success' }}">{{ $result->grade }}</span></h2>
                    <hr>
                    <div class="row text-left">
                        <div class="col-sm-6">
                            <strong><i class="fas fa-book mr-1 text-success"></i> Subject</strong>
                            <p class="text-muted">{{ $result->subject->name }} ({{ $result->subject->code }})</p>
                        </div>
                        <div class="col-sm-6">
                            <strong><i class="fas fa-calendar-check mr-1 text-success"></i> Exam Period</strong>
                            <p class="text-muted">{{ $result->term }}, {{ $result->year }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Student & School Info</h3>
                </div>
                <div class="card-body">
                    <strong><i class="fas fa-user-graduate mr-1 text-success"></i> Student Name</strong>
                    <p class="text-muted">{{ $result->student->full_name }}</p>
                    <hr>
                    <strong><i class="fas fa-id-card mr-1 text-success"></i> Admission Number</strong>
                    <p class="text-muted">{{ $result->student->admission_number }}</p>
                    <hr>
                    <strong><i class="fas fa-school mr-1 text-success"></i> School</strong>
                    <p class="text-muted">{{ $result->school->name }}</p>
                    <hr>
                    <strong><i class="fas fa-info-circle mr-1 text-success"></i> Record Status</strong>
                    <p class="text-muted">
                        <span class="badge badge-{{ $result->status == 'published' ? 'success' : 'secondary' }}">
                            {{ ucfirst($result->status) }}
                        </span>
                    </p>
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
