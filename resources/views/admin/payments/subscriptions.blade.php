@extends('adminlte::page')

@section('title', 'School Subscriptions')

@section('content_header')
    <h1 class="text-success font-weight-bold">School Subscription Status</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold"><i class="fas fa-list mr-1"></i> Subscribed Schools</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="bg-dark">
                                <tr>
                                    <th>School Name</th>
                                    <th>Students</th>
                                    <th>Current Plan</th>
                                    <th>Status</th>
                                    <th>Expiry Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($schools as $school)
                                    <tr>
                                        <td>{{ $school->name }}</td>
                                        <td>{{ $school->students_count }}</td>
                                        <td>Premium</td>
                                        <td><span class="badge badge-success">Active</span></td>
                                        <td>{{ date('d M, Y', strtotime('+1 year')) }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-info" title="Manage Subscription"><i class="fas fa-edit"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="text-center py-4">No schools found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    {{ $schools->links() }}
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
