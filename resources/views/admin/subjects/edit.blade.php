@extends('adminlte::page')

@section('title', 'Edit Subject')

@section('content_header')
    <h1>Edit Subject: {{ $subject->name }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Update Subject Information</h3>
                </div>
                <form action="{{ route('subjects.update', $subject) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Subject Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $subject->name) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="code">Subject Code <span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control" value="{{ old('code', $subject->code) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="category">Category <span class="text-danger">*</span></label>
                            <select name="category" class="form-control" required>
                                <option value="Core" {{ old('category', $subject->category) == 'Core' ? 'selected' : '' }}>Core</option>
                                <option value="Elective" {{ old('category', $subject->category) == 'Elective' ? 'selected' : '' }}>Elective</option>
                                <option value="Specialized" {{ old('category', $subject->category) == 'Specialized' ? 'selected' : '' }}>Specialized</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description', $subject->description) }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-right">
                        <a href="{{ route('subjects.index') }}" class="btn btn-secondary mr-2">Cancel</a>
                        <button type="submit" class="btn btn-warning shadow-sm">Update Subject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
    </style>
@stop
