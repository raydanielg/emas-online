@extends('adminlte::page')

@section('title', 'News & Updates')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-success font-weight-bold">News & System Updates</h1>
        <a href="{{ route('news.create') }}" class="btn btn-warning shadow-sm">
            <i class="fas fa-plus-circle mr-1"></i> Add New Post
        </a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Blog Posts</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="bg-dark">
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($posts as $post)
                                <tr>
                                    <td>{{ $post->title }}</td>
                                    <td><span class="badge badge-info">{{ $post->category }}</span></td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>
                                        <span class="badge badge-{{ $post->status == 'published' ? 'success' : 'secondary' }}">
                                            {{ ucfirst($post->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $post->created_at->format('d M, Y') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('news.edit', $post) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('news.destroy', $post) }}" method="POST" style="display:inline;" id="delete-news-{{ $post->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDeleteNews('delete-news-{{ $post->id }}')"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="text-center py-4">No posts found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDeleteNews(formId) {
            Swal.fire({
                title: 'Unataka kufuta post hii?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ndiyo, futa!'
            }).then((result) => {
                if (result.isConfirmed) document.getElementById(formId).submit();
            })
        }
    </script>
@stop

@section('css')
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
    </style>
@stop
