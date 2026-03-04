@extends('adminlte::page')

@section('title', 'Edit Post')

@section('content_header')
    <h1>Edit News Post</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Update Post</h3>
                </div>
                <form action="{{ route('news.update', $news) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $news->title) }}" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="category">Category <span class="text-danger">*</span></label>
                                <select name="category" class="form-control" required>
                                    <option value="General" {{ $news->category == 'General' ? 'selected' : '' }}>General</option>
                                    <option value="Update" {{ $news->category == 'Update' ? 'selected' : '' }}>System Update</option>
                                    <option value="Announcement" {{ $news->category == 'Announcement' ? 'selected' : '' }}>Announcement</option>
                                    <option value="Event" {{ $news->category == 'Event' ? 'selected' : '' }}>Event</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="status">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control" required>
                                    <option value="draft" {{ $news->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ $news->status == 'published' ? 'selected' : '' }}>Published</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="content">Content <span class="text-danger">*</span></label>
                            <textarea name="content" id="content" class="form-control" rows="10" required>{{ old('content', $news->content) }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-right">
                        <a href="{{ route('news.index') }}" class="btn btn-secondary mr-2">Cancel</a>
                        <button type="submit" class="btn btn-warning shadow-sm">Update Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
