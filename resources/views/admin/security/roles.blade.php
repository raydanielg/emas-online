@extends('adminlte::page')

@section('title', 'Roles Management')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-success font-weight-bold">Security: Roles Management</h1>
        <button class="btn btn-warning shadow-sm"><i class="fas fa-plus mr-1"></i> Add New Role</button>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold"><i class="fas fa-user-shield mr-1"></i> System Roles</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="bg-dark">
                            <tr>
                                <th>Role Name</th>
                                <th>Guard Name</th>
                                <th>Permissions Count</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td><span class="badge badge-info shadow-sm">{{ strtoupper($role->name) }}</span></td>
                                    <td>{{ $role->guard_name }}</td>
                                    <td>{{ $role->permissions->count() }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                    </td>
                                </tr>
                            @endforeach
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
        .bg-warning { background-color: #ffc107 !important; }
    </style>
@stop
