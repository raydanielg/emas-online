@extends('adminlte::page')

@section('title', 'User Profile - ' . $user->name)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>User Profile</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item small"><a href="{{ route('dashboard') }}">dashboard</a></li>
                <li class="breadcrumb-item small"><a href="{{ route('users.index') }}">users</a></li>
                <li class="breadcrumb-item small active" aria-current="page">{{ strtolower($user->name) }}</li>
            </ol>
        </nav>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-outline card-success shadow-sm">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                             src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=0d9488&color=fff' }}"
                             alt="User profile picture"
                             style="width: 100px; height: 100px; object-fit: cover;">
                    </div>

                    <h3 class="profile-username text-center font-weight-bold">{{ $user->name }}</h3>

                    <p class="text-muted text-center text-uppercase small font-weight-bold">
                        {{ $user->getRoleNames()->first() ?? 'No Role' }}
                    </p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Status</b> 
                            <a class="float-right">
                                <span class="badge {{ $user->status === 'active' ? 'badge-success' : 'badge-danger' }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </a>
                        </li>
                        <li class="list-group-item small">
                            <b>School</b> 
                            <a class="float-right text-teal font-weight-bold">
                                {{ $user->school->name ?? 'System Admin' }}
                            </a>
                        </li>
                        <li class="list-group-item small">
                            <b>Member Since</b> <a class="float-right text-dark">{{ $user->created_at->format('M Y') }}</a>
                        </li>
                    </ul>

                    @if($user->id !== auth()->id())
                    <form action="{{ route('users.toggleStatus', $user) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn {{ $user->status === 'active' ? 'btn-danger' : 'btn-success' }} btn-block shadow-sm">
                            <b>{{ $user->status === 'active' ? 'Suspend Account' : 'Activate Account' }}</b>
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#details" data-toggle="tab">Account Details</a></li>
                        <li class="nav-item"><a class="nav-link" href="#edit" data-toggle="tab">Edit User</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <!-- Account Details Tab -->
                        <div class="active tab-pane" id="details">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-teal font-weight-bold border-bottom pb-2 mb-3">Personal Information</h6>
                                    <p><strong>Full Name:</strong> {{ $user->name }}</p>
                                    <p><strong>Email Address:</strong> {{ $user->email }}</p>
                                    <p><strong>Role:</strong> {{ $user->getRoleNames()->first() ?? 'N/A' }}</p>
                                    <p><strong>Last Updated:</strong> {{ $user->updated_at->diffForHumans() }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-teal font-weight-bold border-bottom pb-2 mb-3">School Information</h6>
                                    <p><strong>Associated School:</strong> {{ $user->school->name ?? 'System Admin' }}</p>
                                    <p><strong>School Code:</strong> {{ $user->school->registration_number ?? 'N/A' }}</p>
                                    <p><strong>Location:</strong> {{ $user->school->address ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Tab -->
                        <div class="tab-pane" id="edit">
                            <form action="{{ route('users.update', $user) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control" id="inputName" value="{{ old('name', $user->name) }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control" id="inputEmail" value="{{ old('email', $user->email) }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="school_id" class="col-sm-2 col-form-label">School</label>
                                    <div class="col-sm-10">
                                        <select name="school_id" class="form-control select2" style="width: 100%;">
                                            <option value="">System Admin (No School)</option>
                                            @foreach(\App\Models\School::all() as $school)
                                                <option value="{{ $school->id }}" {{ $user->school_id == $school->id ? 'selected' : '' }}>
                                                    {{ $school->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="role" class="col-sm-2 col-form-label">Role</label>
                                    <div class="col-sm-10">
                                        <select name="role" class="form-control" required>
                                            @foreach(\Spatie\Permission\Models\Role::all() as $role)
                                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                    {{ ucfirst($role->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select name="status" class="form-control" required>
                                            <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="suspended" {{ $user->status === 'suspended' ? 'selected' : '' }}>Suspended</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="profile_photo" class="col-sm-2 col-form-label">Profile Photo</label>
                                    <div class="col-sm-10">
                                        <div class="custom-file">
                                            <input type="file" name="profile_photo" class="custom-file-input" id="profile_photo" accept="image/*">
                                            <label class="custom-file-label" for="profile_photo">Choose photo</label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label small">New Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Leave blank to keep current">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password_confirmation" class="col-sm-2 col-form-label small">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                                    </div>
                                </div>
                                <div class="form-group row mt-4">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-success font-weight-bold shadow-sm px-4">
                                            <i class="fas fa-save mr-1"></i> Update User Details
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>
    $(document).ready(function () {
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    });
</script>
@stop

@section('css')
    <style>
        .profile-user-img { border: 3px solid #0d9488; }
        .card-success.card-outline { border-top: 3px solid #0d9488; }
        .nav-pills .nav-link.active { background-color: #0d9488; }
        .text-teal { color: #0d9488; }
    </style>
@stop
