@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
    <h1>Edit User: {{ $user->name }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Update User Information</h3>
                </div>
                <form action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Assign Role</label>
                            <select name="role" class="form-control" required>
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" {{ in_array($role->name, $userRoles) ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="school_id">Assign School (If not Admin)</label>
                            <select name="school_id" class="form-control select2">
                                <option value="">No School (Admin Only)</option>
                                @foreach($schools as $school)
                                    <option value="{{ $school->id }}" {{ $user->school_id == $school->id ? 'selected' : '' }}>
                                        {{ $school->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="suspended" {{ $user->status == 'suspended' ? 'selected' : '' }}>Suspended</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="password">Password (Leave blank to keep current)</label>
                                <input type="password" name="password" class="form-control" placeholder="New Password">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-right">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-warning shadow-sm">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
