@extends('adminlte::page')

@section('title', 'Results Management')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-success font-weight-bold">Exam Results Management</h1>
        <a href="{{ route('results.create') }}" class="btn btn-warning shadow-sm">
            <i class="fas fa-plus-circle mr-1"></i> Add New Result
        </a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Student Academic Results</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="bg-dark">
                            <tr>
                                <th>Student</th>
                                <th>Subject</th>
                                <th>School</th>
                                <th>Score</th>
                                <th>Grade</th>
                                <th>Term</th>
                                <th>Year</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($results as $result)
                                <tr>
                                    <td>{{ $result->student->full_name }}</td>
                                    <td>{{ $result->subject->name }}</td>
                                    <td>{{ $result->school->name }}</td>
                                    <td><span class="badge badge-info">{{ $result->score }}%</span></td>
                                    <td><span class="badge badge-{{ $result->grade == 'F' ? 'danger' : 'success' }}">{{ $result->grade }}</span></td>
                                    <td>{{ $result->term }}</td>
                                    <td>{{ $result->year }}</td>
                                    <td>
                                        <span class="badge badge-{{ $result->status == 'published' ? 'success' : 'secondary' }}">
                                            {{ ucfirst($result->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('results.show', $result) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('results.edit', $result) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5 text-muted">
                                        <i class="fas fa-poll fa-3x mb-3"></i>
                                        <p>Hakuna matokeo yaliyopatikana.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white">
                    {{ $results->links() }}
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
