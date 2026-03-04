@extends('adminlte::page')

@section('title', 'Users Management')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Users Management</h1>
        <a href="{{ route('users.create') }}" class="btn btn-warning">
            <i class="fas fa-plus"></i> Add New User
        </a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-success">
                <div class="card-header" style="background-color: #ffc107; color: #000;">
                    <h3 class="card-title text-dark">System Users</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped">
                        <thead class="bg-dark">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            <span class="badge badge-success">{{ ucfirst($role->name) }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $user->created_at->format('d M, Y') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-info" title="View Profile"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning text-dark" title="Edit User"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')" title="Delete User"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white">
                    {{ $users->links() }}
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
