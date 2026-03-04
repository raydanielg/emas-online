@extends('adminlte::page')

@section('title', 'System Announcements')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-success font-weight-bold">Announcements Management</h1>
        <button class="btn btn-warning shadow-sm"><i class="fas fa-plus-circle mr-1"></i> New Announcement</button>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold"><i class="fas fa-bullhorn mr-1"></i> Recent Announcements</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="bg-dark">
                            <tr>
                                <th>Title</th>
                                <th>Target Audience</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>System Maintenance Scheduled</td>
                                <td><span class="badge badge-info">All Users</span></td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>Admin</td>
                                <td>01 Mar, 2024</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
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
