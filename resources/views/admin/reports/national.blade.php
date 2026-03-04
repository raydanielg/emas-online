@extends('adminlte::page')

@section('title', 'National Performance Overview')

@section('content_header')
    <h1 class="text-success font-weight-bold">National Performance Overview</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold"><i class="fas fa-chart-bar mr-1"></i> Performance Statistics</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="info-box bg-success shadow-sm">
                                <span class="info-box-icon"><i class="fas fa-check-circle"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Overall Pass Rate</span>
                                    <span class="info-box-number">88.5%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box bg-warning shadow-sm">
                                <span class="info-box-icon text-dark"><i class="fas fa-school"></i></span>
                                <div class="info-box-content text-dark">
                                    <span class="info-box-text">Top Performing Region</span>
                                    <span class="info-box-number">Dar es Salaam</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <h5>Performance Trends</h5>
                        <p class="text-muted">Graph visualization placeholder for national trends...</p>
                        <div style="height: 300px; background: #f4f6f9; border-radius: 8px; border: 1px dashed #28a745; display: flex; align-items: center; justify-content: center;">
                            <span class="text-success font-weight-bold">National Performance Graph Area</span>
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
