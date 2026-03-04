@extends('adminlte::page')

@section('title', 'Add New School')

@section('content_header')
    <h1>Register New School</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card card-success card-outline">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">School Registration Form</h3>
                </div>
                <form action="{{ route('schools.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="name">School Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter school name" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="registration_number">Registration Number <span class="text-danger">*</span></label>
                                <input type="text" name="registration_number" class="form-control" id="registration_number" placeholder="e.g. S.1234/5678" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="email">School Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="school@example.com" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" name="phone" class="form-control" id="phone" placeholder="+255 ...">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" class="form-control" id="address" rows="2" placeholder="School location/address"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="category">Category</label>
                                <select name="category" class="form-control" id="category">
                                    <option value="Government">Government</option>
                                    <option value="Private">Private</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="level">Level</label>
                                <select name="level" class="form-control" id="level">
                                    <option value="Primary">Primary</option>
                                    <option value="Secondary">Secondary</option>
                                    <option value="O-Level">O-Level</option>
                                    <option value="A-Level">A-Level</option>
                                    <option value="Both">Both (O & A Level)</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="logo">School Logo</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="logo" class="custom-file-input" id="logo">
                                    <label class="custom-file-label" for="logo">Choose file</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Brief Description</label>
                            <textarea name="description" class="form-control" id="description" rows="3" placeholder="About the school..."></textarea>
                        </div>
                    </div>

                    <div class="card-footer bg-white text-right">
                        <a href="{{ route('schools.index') }}" class="btn btn-secondary mr-2">Cancel</a>
                        <button type="submit" class="btn btn-warning shadow">
                            <i class="fas fa-save mr-1"></i> Save School
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        // Update file input label
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
@stop

@section('css')
    <style>
        .card-success.card-outline {
            border-top: 3px solid #28a745;
        }
    </style>
@stop
