@extends('adminlte::page')

@section('title', 'Manage Permissions')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-success font-weight-bold">Security: Permissions</h1>
        <button class="btn btn-warning shadow-sm"><i class="fas fa-plus mr-1"></i> Add Permission</button>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold"><i class="fas fa-key mr-1"></i> System Permissions</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="bg-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Permission Name</th>
                                    <th>Guard</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>#{{ $permission->id }}</td>
                                        <td><span class="badge badge-light border">{{ $permission->name }}</span></td>
                                        <td>{{ $permission->guard_name }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
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
    </style>
@stop
