@extends('adminlte::page')

@section('title', 'Add New Class')

@section('content_header')
    <h1 class="text-success font-weight-bold">Add New Class</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Class Details</h3>
                </div>
                <form action="{{ route('admin.classes.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Global Class Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="e.g. Form One, Standard One" required>
                        </div>
                        <div class="form-group">
                            <label for="level">School Level</label>
                            <select name="level" id="level" class="form-control" required>
                                <option value="">Select Level</option>
                                <option value="Primary">Primary</option>
                                <option value="O-Level">O-Level</option>
                                <option value="A-Level">A-Level</option>
                                <option value="Secondary">Secondary</option>
                                <option value="College">College</option>
                                <option value="Both">Both</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Save Global Class</button>
                        <a href="{{ route('admin.classes.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
