@extends('adminlte::page')

@section('title', 'School Performance Rankings')

@section('content_header')
    <h1 class="text-success font-weight-bold">School Performance Rankings</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold"><i class="fas fa-trophy mr-1"></i> Top 10 Best Performing Schools</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="bg-dark">
                                <tr>
                                    <th>Rank</th>
                                    <th>School Name</th>
                                    <th>Region</th>
                                    <th>Avg Score</th>
                                    <th>Pass Rate</th>
                                    <th>Performance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge badge-warning">1</span></td>
                                    <td>Mlimani Secondary School</td>
                                    <td>Dar es Salaam</td>
                                    <td>88.4%</td>
                                    <td>100%</td>
                                    <td><div class="progress progress-xs"><div class="progress-bar bg-success" style="width: 88%"></div></div></td>
                                </tr>
                                <tr>
                                    <td><span class="badge badge-secondary">2</span></td>
                                    <td>Arusha Technical School</td>
                                    <td>Arusha</td>
                                    <td>85.2%</td>
                                    <td>99.1%</td>
                                    <td><div class="progress progress-xs"><div class="progress-bar bg-success" style="width: 85%"></div></div></td>
                                </tr>
                                <tr>
                                    <td><span class="badge badge-warning" style="background-color: #cd7f32">3</span></td>
                                    <td>Mwanza Heights Primary</td>
                                    <td>Mwanza</td>
                                    <td>82.8%</td>
                                    <td>98.5%</td>
                                    <td><div class="progress progress-xs"><div class="progress-bar bg-success" style="width: 82%"></div></div></td>
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
