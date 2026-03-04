@extends('adminlte::page')

@section('title', 'School Levels')

@section('content_header')
    <h1 class="text-success font-weight-bold">School Levels</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Add New Level</h3>
                </div>
                <form action="{{ route('schools.levels.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Level Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Primary, O-Level" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-right">
                        <button type="submit" class="btn btn-warning shadow-sm">Save Level</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning d-flex justify-content-between align-items-center">
                    <h3 class="card-title text-dark font-weight-bold">Available Levels</h3>
                    <div class="card-tools">
                        <form action="{{ route('schools.levels.seed') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-dark shadow-sm">
                                <i class="fas fa-file-import mr-1"></i> Import Default Levels
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($levels as $level)
                                <tr>
                                    <td><span class="badge badge-info">{{ $level->name }}</span></td>
                                    <td>{{ $level->description ?? 'N/A' }}</td>
                                    <td>
                                        <form action="{{ route('schools.levels.destroy', $level) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-center">No levels found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
