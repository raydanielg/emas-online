@extends('adminlte::page')

@section('title', 'Classes Management')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-success font-weight-bold">Classes Management</h1>
        <a href="{{ route('admin.classes.create') }}" class="btn btn-warning shadow-sm">
            <i class="fas fa-plus-circle mr-1"></i> Add New Class
        </a>
    </div>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card card-outline card-success shadow-sm">
        <div class="card-header bg-warning">
            <h3 class="card-title text-dark font-weight-bold">All Classes</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Global Class Name</th>
                            <th>Level</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($classes as $class)
                            <tr>
                                <td class="font-weight-bold">{{ $class->name }}</td>
                                <td>
                                    <span class="badge badge-info">{{ $class->level }}</span>
                                </td>
                                <td class="text-right">
                                    <form action="{{ route('admin.classes.destroy', $class) }}" method="POST" onsubmit="return confirm('Delete this global class?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <p class="mb-0">No classes found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            {{ $classes->links() }}
        </div>
    </div>
@stop
