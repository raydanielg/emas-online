@extends('adminlte::page')

@section('title', 'Promote Students')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="text-success font-weight-bold mb-0">Promote Students</h1>
            <small class="text-muted">Move students to the next class level</small>
        </div>
        <div>
            <a href="{{ route('user.students.manage') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left mr-1"></i> Back to Manage
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-white">
                    <h3 class="card-title text-dark">
                        <i class="fas fa-graduation-cap mr-1 text-success"></i> Batch Promotion
                    </h3>
                </div>
                <div class="card-body py-5 text-center">
                    <i class="fas fa-tools fa-4x mb-3 text-warning"></i>
                    <h3>Coming Soon</h3>
                    <p class="text-muted">This feature will allow you to select a class and promote all students to the next level in one click.</p>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .card-outline.card-success { border-top: 3px solid #28a745; }
    </style>
@stop
