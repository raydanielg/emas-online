@extends('adminlte::page')

@section('title', 'Regional Performance')

@section('content_header')
    <h1 class="text-success font-weight-bold">Regional Performance Analytics</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold"><i class="fas fa-map-marker-alt mr-1"></i> Regional Comparison</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="bg-dark">
                                <tr>
                                    <th>Region</th>
                                    <th>Total Schools</th>
                                    <th>Total Students</th>
                                    <th>Avg Score</th>
                                    <th>Pass Rate</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Dar es Salaam</td>
                                    <td>450</td>
                                    <td>125,000</td>
                                    <td>78.4%</td>
                                    <td>92.1%</td>
                                    <td><button class="btn btn-sm btn-info">View Details</button></td>
                                </tr>
                                <tr>
                                    <td>Arusha</td>
                                    <td>320</td>
                                    <td>85,000</td>
                                    <td>75.2%</td>
                                    <td>89.5%</td>
                                    <td><button class="btn btn-sm btn-info">View Details</button></td>
                                </tr>
                                <tr>
                                    <td>Mwanza</td>
                                    <td>380</td>
                                    <td>110,000</td>
                                    <td>72.8%</td>
                                    <td>86.4%</td>
                                    <td><button class="btn btn-sm btn-info">View Details</button></td>
                                </tr>
                            </tbody>
                        </table>
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
