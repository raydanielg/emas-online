@extends('adminlte::page')

@section('title', 'Security Logs')

@section('content_header')
    <h1 class="text-success font-weight-bold">Security & Activity Logs</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-danger shadow-sm">
                <span class="info-box-icon"><i class="fas fa-exclamation-triangle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Failed Logins (24h)</span>
                    <span class="info-box-number">12</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-warning shadow-sm">
                <span class="info-box-icon text-dark"><i class="fas fa-user-shield"></i></span>
                <div class="info-box-content text-dark">
                    <span class="info-box-text">Role Changes</span>
                    <span class="info-box-number">5</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-outline card-success shadow-sm">
        <div class="card-header bg-warning">
            <h3 class="card-title text-dark font-weight-bold"><i class="fas fa-list-alt mr-1"></i> System Activity Logs</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="bg-dark">
                        <tr>
                            <th>User</th>
                            <th>Action</th>
                            <th>Module</th>
                            <th>IP Address</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Admin User</td>
                            <td><span class="badge badge-success">Update</span></td>
                            <td>Settings</td>
                            <td>127.0.0.1</td>
                            <td>2 mins ago</td>
                        </tr>
                        <tr>
                            <td>School Manager</td>
                            <td><span class="badge badge-primary">Create</span></td>
                            <td>Students</td>
                            <td>192.168.1.5</td>
                            <td>15 mins ago</td>
                        </tr>
                        <tr>
                            <td>Unknown</td>
                            <td><span class="badge badge-danger">Failed Login</span></td>
                            <td>Auth</td>
                            <td>45.12.33.1</td>
                            <td>1 hour ago</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
    </style>
@stop
