@extends('adminlte::page')

@section('title', 'Schools Management')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Schools Management</h1>
        <a href="{{ route('schools.create') }}" class="btn btn-warning">
            <i class="fas fa-plus"></i> Add New School
        </a>
    </div>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-success">
                <div class="card-header" style="background-color: #ffc107; color: #000;">
                    <h3 class="card-title">List of All Schools</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped">
                        <thead class="bg-dark">
                            <tr>
                                <th>Logo</th>
                                <th>School Name</th>
                                <th>Reg Number</th>
                                <th>Category</th>
                                <th>Level</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($schools as $school)
                                <tr>
                                    <td>
                                        @if($school->logo)
                                            <img src="{{ asset('storage/' . $school->logo) }}" width="40" class="img-circle">
                                        @else
                                            <i class="fas fa-school fa-2x text-success"></i>
                                        @endif
                                    </td>
                                    <td>{{ $school->name }}</td>
                                    <td><span class="badge badge-info">{{ $school->registration_number }}</span></td>
                                    <td>{{ $school->category }}</td>
                                    <td>{{ $school->level }}</td>
                                    <td>
                                        @if($school->status == 'Approved')
                                            <span class="badge badge-success">Approved</span>
                                        @elseif($school->status == 'Pending')
                                            <span class="badge badge-warning text-dark">Pending</span>
                                        @else
                                            <span class="badge badge-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('schools.show', $school) }}" class="btn btn-sm btn-info" title="View"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('schools.edit', $school) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>

                                            @if($school->status == 'Pending')
                                                <button type="button" class="btn btn-sm btn-success" title="Quick Approve"
                                                    data-toggle="modal" data-target="#quickApproveModal{{ $school->id }}">
                                                    <i class="fas fa-check-circle"></i>
                                                </button>
                                            @endif

                                            <form action="{{ route('schools.destroy', $school) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this school?')"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>

                                        @if($school->status == 'Pending')
                                            <div class="modal fade" id="quickApproveModal{{ $school->id }}" tabindex="-1" role="dialog" aria-labelledby="quickApproveModalLabel{{ $school->id }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="quickApproveModalLabel{{ $school->id }}">Confirm School Approval</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <p class="mb-2">Unakaribia ku-approve shule hii. Tafadhali hakiki taarifa kabla ya kuendelea:</p>

                                                            <ul class="list-group">
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span>School Name</span>
                                                                    <strong>{{ $school->name }}</strong>
                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span>Reg Number</span>
                                                                    <strong>{{ $school->registration_number }}</strong>
                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span>Email</span>
                                                                    <strong>{{ $school->email }}</strong>
                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span>Category</span>
                                                                    <strong>{{ $school->category }}</strong>
                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span>Level</span>
                                                                    <strong>{{ $school->level }}</strong>
                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span>Owner (User ID)</span>
                                                                    <strong>{{ $school->user_id }}</strong>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                                                            <form action="{{ route('schools.quickApprove', $school) }}" method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-success">Approve Now</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-folder-open fa-3x mb-3"></i>
                                            <p>No schools found in the system.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix bg-white">
                    {{ $schools->links() }}
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .card-success.card-outline {
            border-top: 3px solid #28a745;
        }
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #000;
        }
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
            color: #000;
        }
    </style>
@stop
