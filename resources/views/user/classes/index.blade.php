@extends('adminlte::page')

@section('title', 'My Classes')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="text-success font-weight-bold mb-0">My Classes</h1>
            <small class="text-muted">Classes currently active in your school</small>
        </div>
        <div>
            <a href="{{ route('user.classes.assign') }}" class="btn btn-warning shadow-sm">
                <i class="fas fa-plus-circle mr-1"></i> Import/Add From System
            </a>
        </div>
    </div>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card card-outline card-success shadow-sm">
        <div class="card-header bg-white py-3 border-bottom-0">
            <h3 class="card-title text-dark">
                <i class="fas fa-school mr-1 text-success"></i> School Classes
            </h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="thead-light border-top">
                        <tr>
                            <th class="px-4">Class Name</th>
                            <th>Level</th>
                            <th class="text-right px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($classes as $class)
                            <tr>
                                <td class="px-4 font-weight-bold">{{ $class->globalClass->name ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge badge-info">{{ $class->globalClass->level ?? 'N/A' }}</span>
                                </td>
                                <td class="text-right px-4">
                                    <form action="{{ route('user.classes.destroy', $class) }}" method="POST" onsubmit="return confirm('Remove this class from your school?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger border-0" title="Remove">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-5 text-muted">
                                    <i class="fas fa-layer-group fa-3x mb-3 text-muted"></i>
                                    <p class="mb-0">No classes assigned to your school yet.</p>
                                    <a href="{{ route('user.classes.assign') }}" class="btn btn-sm btn-success mt-3">Import Classes Now</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white clearfix">
            <div class="float-right">
                {{ $classes->links() }}
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
    </style>
@stop
