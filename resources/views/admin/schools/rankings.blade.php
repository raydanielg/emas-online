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
                    <h3 class="card-title text-dark font-weight-bold"><i class="fas fa-trophy mr-1"></i> Top Performing Schools</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="bg-dark">
                            <tr>
                                <th>Rank</th>
                                <th>School Name</th>
                                <th>Category</th>
                                <th>Average Score</th>
                                <th>Pass Rate</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="badge badge-warning">1</span></td>
                                <td>Mlimani Secondary</td>
                                <td>Government</td>
                                <td>85.4%</td>
                                <td>100%</td>
                                <td><span class="badge badge-success">Approved</span></td>
                            </tr>
                            <tr>
                                <td><span class="badge badge-secondary">2</span></td>
                                <td>Kurasini Primary</td>
                                <td>Private</td>
                                <td>82.1%</td>
                                <td>98.5%</td>
                                <td><span class="badge badge-success">Approved</span></td>
                            </tr>
                        </tbody>
                    </table>
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
