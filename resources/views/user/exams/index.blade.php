@extends('adminlte::page')

@section('title', 'Exam List')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-success font-weight-bold">Exam Management</h1>
        <a href="{{ route('user.exams.create') }}" class="btn btn-warning shadow-sm">
            <i class="fas fa-plus-circle mr-1"></i> Create New Exam
        </a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Scheduled Exams</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="bg-dark">
                            <tr>
                                <th>Exam Name</th>
                                <th>Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($exams as $exam)
                                <tr>
                                    <td>{{ $exam->name }}</td>
                                    <td>{{ $exam->type }}</td>
                                    <td>{{ $exam->start_date }}</td>
                                    <td>{{ $exam->end_date }}</td>
                                    <td>
                                        <span class="badge badge-{{ $exam->is_active ? 'success' : 'secondary' }}">
                                            {{ $exam->is_active ? 'Active' : 'Closed' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('user.exams.edit', $exam) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('user.exams.destroy', $exam) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="text-center py-4 text-muted">No exams found.</td></tr>
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
