@extends('adminlte::page')

@section('title', 'Data Management')

@section('content_header')
    <h1 class="text-success font-weight-bold">System Data & Maintenance</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold"><i class="fas fa-broom mr-1"></i> System Cache</h3>
                </div>
                <div class="card-body">
                    <p>Cleaning the cache can resolve issues with updated configurations or routes not reflecting.</p>
                    <form action="{{ route('data.clearCache') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-block shadow-sm">
                            <i class="fas fa-sync-alt mr-1"></i> Clear All System Cache
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold"><i class="fas fa-database mr-1"></i> Database Status</h3>
                </div>
                <div class="card-body">
                    <div class="info-box bg-light shadow-none border">
                        <span class="info-box-icon bg-success"><i class="fas fa-table"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Tables</span>
                            <span class="info-box-number">24</span>
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
        .bg-warning { background-color: #ffc107 !important; }
    </style>
@stop
