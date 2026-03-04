@extends('adminlte::page')

@section('title', 'Subject Details')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-success font-weight-bold">Subject Details</h1>
        <div>
            <a href="{{ route('subjects.index') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left mr-1"></i> Back
            </a>
            <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-warning shadow-sm">
                <i class="fas fa-edit mr-1"></i> Edit Subject
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Basic Information</h3>
                </div>
                <div class="card-body">
                    <strong><i class="fas fa-book mr-1 text-success"></i> Subject Name</strong>
                    <p class="text-muted">{{ $subject->name }}</p>
                    <hr>
                    <strong><i class="fas fa-code mr-1 text-success"></i> Subject Code</strong>
                    <p class="text-muted">{{ $subject->code }}</p>
                    <hr>
                    <strong><i class="fas fa-tags mr-1 text-success"></i> Category</strong>
                    <p class="text-muted">
                        <span class="badge badge-info">{{ $subject->category }}</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Description</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">{{ $subject->description ?? 'No description provided.' }}</p>
                    <hr>
                    <strong><i class="fas fa-clock mr-1 text-success"></i> Created At</strong>
                    <p class="text-muted">{{ $subject->created_at->format('d M, Y H:i') }}</p>
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
