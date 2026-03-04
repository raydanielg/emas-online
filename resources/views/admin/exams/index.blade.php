@extends('adminlte::page')

@section('title', 'Exams Management')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Exams Management</h1>
        <a href="{{ route('exams.create') }}" class="btn btn-success font-weight-bold shadow-sm">
            <i class="fas fa-plus mr-1"></i> Create New Exam
        </a>
    </div>
@stop

@section('content')
    <div class="card card-outline card-success shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0">
                <thead class="thead-light">
                    <tr>
                        <th>Exam Name</th>
                        <th>Type</th>
                        <th>School / Level</th>
                        <th>Year / Term</th>
                        <th>Status</th>
                        <th>Published</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($exams as $exam)
                        <tr>
                            <td>
                                <span class="font-weight-bold">{{ $exam->name }}</span>
                                <br>
                                <small class="text-muted">{{ $exam->start_date ? $exam->start_date->format('d M Y') : 'N/A' }}</small>
                            </td>
                            <td>
                                <span class="badge badge-info">{{ $exam->type }}</span>
                            </td>
                            <td>
                                {{ $exam->school->name ?? 'Regional / National' }}
                            </td>
                            <td>
                                {{ $exam->academicYear->year }} - {{ $exam->term }}
                            </td>
                            <td>
                                <span class="badge {{ $exam->is_active ? 'badge-success' : 'badge-danger' }}">
                                    {{ $exam->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('exams.publish', $exam) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $exam->is_published ? 'btn-success' : 'btn-outline-secondary' }} rounded-pill px-3">
                                        <i class="fas {{ $exam->is_published ? 'fa-check-circle' : 'fa-upload' }} mr-1"></i>
                                        {{ $exam->is_published ? 'Published' : 'Publish' }}
                                    </button>
                                </form>
                            </td>
                            <td class="text-right">
                                <div class="btn-group">
                                    <a href="{{ route('exams.show', $exam) }}" class="btn btn-sm btn-info shadow-sm" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('exams.edit', $exam) }}" class="btn btn-sm btn-warning shadow-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('exams.destroy', $exam) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this exam?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger shadow-sm" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="fas fa-file-invoice fa-3x text-gray-200 mb-3"></i>
                                <p class="text-muted">No exams found. Start by creating one.</p>
                                <a href="{{ route('exams.create') }}" class="btn btn-sm btn-success">Create Exam</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($exams->hasPages())
            <div class="card-footer clearfix">
                {{ $exams->links() }}
            </div>
        @endif
    </div>
@stop

@section('css')
    <style>
        .card-success.card-outline { border-top: 3px solid #0d9488; }
        .btn-success { background-color: #0d9488; border-color: #0d9488; }
        .btn-success:hover { background-color: #0f766e; border-color: #0f766e; }
        .text-teal { color: #0d9488; }
    </style>
@stop
