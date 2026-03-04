@extends('adminlte::page')

@section('title', 'Grade Boundaries')

@section('content_header')
    <h1 class="text-success font-weight-bold">Grade Management</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Set Grade Boundary</h3>
                </div>
                <form action="#" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Grade Letter</label>
                            <input type="text" name="grade" class="form-control" placeholder="e.g. A" required>
                        </div>
                        <div class="row">
                            <div class="col-6 form-group">
                                <label>Min Score</label>
                                <input type="number" name="min_score" class="form-control" placeholder="0" required>
                            </div>
                            <div class="col-6 form-group">
                                <label>Max Score</label>
                                <input type="number" name="max_score" class="form-control" placeholder="100" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Remark</label>
                            <input type="text" name="remark" class="form-control" placeholder="e.g. Excellent">
                        </div>
                    </div>
                    <div class="card-footer bg-white text-right">
                        <button type="submit" class="btn btn-warning shadow-sm">Save Boundary</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Current Grading Scale</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="bg-dark">
                            <tr>
                                <th>Grade</th>
                                <th>Range</th>
                                <th>Remark</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($grades ?? [] as $grade)
                                <tr>
                                    <td><span class="badge badge-success">{{ $grade->grade }}</span></td>
                                    <td>{{ $grade->min_score }} - {{ $grade->max_score }}</td>
                                    <td>{{ $grade->remark }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center py-4">No grades defined yet.</td></tr>
                            @endforelse
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
