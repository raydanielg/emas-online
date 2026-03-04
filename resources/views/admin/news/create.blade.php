@extends('adminlte::page')

@section('title', 'Add New Post')

@section('content_header')
    <h1>Create News Post</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Post Details</h3>
                </div>
                <form action="{{ route('news.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" placeholder="Enter post title" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="category">Category <span class="text-danger">*</span></label>
                                <select name="category" class="form-control" required>
                                    <option value="General">General</option>
                                    <option value="Update">System Update</option>
                                    <option value="Announcement">Announcement</option>
                                    <option value="Event">Event</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="status">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control" required>
                                    <option value="draft">Draft</option>
                                    <option value="published">Published</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="content">Content <span class="text-danger">*</span></label>
                            <textarea name="content" id="content" class="form-control" rows="10" placeholder="Write your content here..." required></textarea>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-right">
                        <a href="{{ route('news.index') }}" class="btn btn-secondary mr-2">Cancel</a>
                        <button type="submit" class="btn btn-warning shadow-sm">Save Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
