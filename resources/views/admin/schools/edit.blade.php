@extends('adminlte::page')

@section('title', 'Edit School')

@section('content_header')
    <h1>Edit School: {{ $school->name }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card card-success card-outline shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Update School Information</h3>
                </div>
                <form action="{{ route('schools.update', $school) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="name">School Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $school->name) }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="registration_number">Registration Number <span class="text-danger">*</span></label>
                                <input type="text" name="registration_number" class="form-control" id="registration_number" value="{{ old('registration_number', $school->registration_number) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="email">School Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $school->email) }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone', $school->phone) }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" class="form-control" id="address" rows="2">{{ old('address', $school->address) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="category">Category</label>
                                <select name="category" class="form-control" id="category">
                                    <option value="Government" {{ old('category', $school->category) == 'Government' ? 'selected' : '' }}>Government</option>
                                    <option value="Private" {{ old('category', $school->category) == 'Private' ? 'selected' : '' }}>Private</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="level">Level</label>
                                <select name="level" class="form-control" id="level">
                                    <option value="Primary" {{ old('level', $school->level) == 'Primary' ? 'selected' : '' }}>Primary</option>
                                    <option value="Secondary" {{ old('level', $school->level) == 'Secondary' ? 'selected' : '' }}>Secondary</option>
                                    <option value="O-Level" {{ old('level', $school->level) == 'O-Level' ? 'selected' : '' }}>O-Level</option>
                                    <option value="A-Level" {{ old('level', $school->level) == 'A-Level' ? 'selected' : '' }}>A-Level</option>
                                    <option value="Both" {{ old('level', $school->level) == 'Both' ? 'selected' : '' }}>Both (O & A Level)</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="Pending" {{ old('status', $school->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Approved" {{ old('status', $school->status) == 'Approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="Rejected" {{ old('status', $school->status) == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="logo">Update Logo (Optional)</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="logo" class="custom-file-input" id="logo">
                                    <label class="custom-file-label" for="logo">Choose new file</label>
                                </div>
                            </div>
                            @if($school->logo)
                                <div class="mt-2 text-success">
                                    <i class="fas fa-image"></i> Current logo exists.
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="description">Brief Description</label>
                            <textarea name="description" class="form-control" id="description" rows="3">{{ old('description', $school->description) }}</textarea>
                        </div>
                    </div>

                    <div class="card-footer bg-white text-right">
                        <a href="{{ route('schools.index') }}" class="btn btn-secondary mr-2">Cancel</a>
                        <button type="submit" class="btn btn-warning shadow-sm">
                            <i class="fas fa-save mr-1"></i> Update Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
@stop

@section('css')
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
    </style>
@stop
