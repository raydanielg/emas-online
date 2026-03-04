@extends('adminlte::page')

@section('title', 'Subjects Management')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-success font-weight-bold">Subjects Management</h1>
        <div class="d-flex">
            <form action="{{ route('subjects.seed') }}" method="POST" class="mr-2">
                @csrf
                <button type="submit" class="btn btn-dark shadow-sm">
                    <i class="fas fa-file-import mr-1"></i> Import All Subjects
                </button>
            </form>
            <a href="{{ route('subjects.create') }}" class="btn btn-warning shadow-sm">
                <i class="fas fa-plus-circle mr-1"></i> Add New Subject
            </a>
        </div>
    </div>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-4">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">
                        <i class="fas fa-plus-circle mr-1"></i> Create Subject
                    </h3>
                </div>
                <form action="{{ route('subjects.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="code">Subject Code</label>
                            <input type="text" name="code" id="code" class="form-control" value="{{ old('code') }}" placeholder="e.g. 031" required>
                            <small class="text-muted">Code lazima iwe unique (mf 031, 012).</small>
                        </div>

                        <div class="form-group">
                            <label for="name">Subject Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="e.g. Mathematics" required>
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            @php($selectedCategory = old('category', 'Core'))
                            <select name="category" id="category" class="form-control" required>
                                <option value="Core" {{ $selectedCategory === 'Core' ? 'selected' : '' }}>Core</option>
                                <option value="Elective" {{ $selectedCategory === 'Elective' ? 'selected' : '' }}>Elective</option>
                                <option value="Specialized" {{ $selectedCategory === 'Specialized' ? 'selected' : '' }}>Specialized</option>
                            </select>
                        </div>

                        <div class="form-group mb-0">
                            <label for="description">Description (optional)</label>
                            <textarea name="description" id="description" class="form-control" rows="3" placeholder="Short description...">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-block font-weight-bold">
                            <i class="fas fa-save mr-1"></i> Save Subject
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">List of Subjects</h3>
                </div>
                <div class="card-body border-bottom">
                    <form method="GET" action="{{ route('subjects.index') }}" class="mb-0">
                        <div class="form-row align-items-end">
                            <div class="col-md-6">
                                <label class="small text-muted mb-1">Search</label>
                                <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Search by name, code, category...">
                            </div>
                            <div class="col-md-4">
                                <label class="small text-muted mb-1">Category</label>
                                <select name="category" class="form-control">
                                    <option value="">All Categories</option>
                                    <option value="Core" {{ request('category') === 'Core' ? 'selected' : '' }}>Core</option>
                                    <option value="Elective" {{ request('category') === 'Elective' ? 'selected' : '' }}>Elective</option>
                                    <option value="Specialized" {{ request('category') === 'Specialized' ? 'selected' : '' }}>Specialized</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-success btn-block">
                                    <i class="fas fa-search mr-1"></i> Filter
                                </button>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="small text-muted">
                                Total: <strong>{{ $subjects->total() }}</strong>
                            </div>
                            <a href="{{ route('subjects.index') }}" class="small">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Code</th>
                                <th>Subject Name</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subjects as $subject)
                                <tr>
                                    <td><span class="badge badge-info shadow-sm">{{ $subject->code }}</span></td>
                                    <td class="font-weight-bold">{{ $subject->name }}</td>
                                    <td>
                                        <span class="badge badge-{{ $subject->category === 'Core' ? 'success' : ($subject->category === 'Elective' ? 'warning' : 'secondary') }}">
                                            {{ $subject->category }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('subjects.show', $subject) }}" class="btn btn-sm btn-info" title="View"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('subjects.destroy', $subject) }}" method="POST" style="display:inline;" id="delete-subject-{{ $subject->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDeleteSubject('delete-subject-{{ $subject->id }}')" title="Delete"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="fas fa-book-open fa-3x mb-3"></i>
                                        <p>No subjects found in the system.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white">
                    {{ $subjects->links() }}
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDeleteSubject(formId) {
            Swal.fire({
                title: 'Je, una uhakika?',
                text: "Somo hili litafutwa kabisa!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ndiyo, futa!',
                cancelButtonText: 'Ghairi'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            })
        }
    </script>
@stop

@section('css')
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
        .bg-warning { background-color: #ffc107 !important; }
        .btn-warning { background-color: #ffc107; border-color: #ffc107; color: #000; }
        .btn-warning:hover { background-color: #e0a800; border-color: #d39e00; color: #000; }
    </style>
@stop
