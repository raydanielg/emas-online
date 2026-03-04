@extends('adminlte::page')

@section('title', 'Admin Profile')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Profile</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item small"><a href="{{ route('dashboard') }}">dashboard</a></li>
                <li class="breadcrumb-item small active" aria-current="page">profile</li>
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
                            <b>Status</b> <a class="float-right"><span class="badge badge-success">Active</span></a>
                        </li>
                        <li class="list-group-item small">
                            <b>Member Since</b> <a class="float-right">{{ $user->created_at->format('M Y') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="settings">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form action="{{ route('admin.profile.update') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control" id="inputName" placeholder="Name" value="{{ old('name', $user->name) }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" value="{{ old('email', $user->email) }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="profile_photo" class="col-sm-2 col-form-label">Profile Photo</label>
                                    <div class="col-sm-10">
                                        <div class="custom-file">
                                            <input type="file" name="profile_photo" class="custom-file-input" id="profile_photo" accept="image/*">
                                            <label class="custom-file-label" for="profile_photo">Choose file</label>
                                        </div>
                                        <small class="text-muted">Max size: 2MB (JPEG, PNG, JPG)</small>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row text-muted">
                                    <div class="offset-sm-2 col-sm-10">
                                        <p class="small">Leave password fields blank if you don't want to change it.</p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label small">Current Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="current_password" class="form-control" id="inputPassword" placeholder="Required only if changing password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputNewPassword" class="col-sm-2 col-form-label small">New Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="new_password" class="form-control" id="inputNewPassword" placeholder="New Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputConfirmPassword" class="col-sm-2 col-form-label small">Confirm New Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="new_password_confirmation" class="form-control" id="inputConfirmPassword" placeholder="Confirm New Password">
                                    </div>
                                </div>
                                <div class="form-group row mt-4">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-success font-weight-bold shadow-sm px-4">
                                            <i class="fas fa-save mr-1"></i> Update Profile
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
    // Show filename in custom file input
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>
@stop

@section('css')
    <style>
        .profile-user-img { border: 3px solid #0d9488; }
        .card-success.card-outline { border-top: 3px solid #0d9488; }
        .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
            background-color: #0d9488;
        }
    </style>
@stop
