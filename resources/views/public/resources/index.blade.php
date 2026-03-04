@extends('layouts.public')

@section('title', 'Resources & Teaching Materials')

@section('content')
<div class="container py-5">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-teal-900 mb-2">Teaching Materials & Resources</h2>
        <p class="text-gray-600">Access quality educational resources, past papers, and teaching aids.</p>
    </div>

    <!-- Filter Section -->
    <div class="card border-0 shadow-sm rounded-xl mb-8">
        <div class="card-body p-4">
            <form action="{{ route('public.resources.index') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label small font-weight-bold text-teal-800">Filter by Subject</label>
                    <select name="subject" class="form-control rounded-lg border-teal-100">
                        <option value="">All Subjects</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ request('subject') == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small font-weight-bold text-teal-800">Resource Type</label>
                    <select name="type" class="form-control rounded-lg border-teal-100">
                        <option value="">All Types</option>
                        @foreach($types as $type)
                            <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-teal w-100 rounded-lg font-weight-bold shadow-sm">
                        <i class="fas fa-filter mr-1"></i> Apply Filters
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Resources Grid -->
    <div class="row">
        @forelse($resources as $resource)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 feature-card">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="w-12 h-12 bg-teal-50 rounded-lg flex items-center justify-center">
                                @php
                                    $icon = match($resource->type) {
                                        'Lesson Plan' => 'fas fa-chalkboard-teacher',
                                        'Past Paper' => 'fas fa-file-pdf',
                                        'Syllabus' => 'fas fa-book',
                                        'E-Learning' => 'fas fa-video',
                                        default => 'fas fa-file-alt'
                                    };
                                @endphp
                                <i class="{{ $icon }} text-teal-600 text-xl"></i>
                            </div>
                            <span class="badge badge-pill bg-teal-100 text-teal-700 px-3 py-1 small">{{ $resource->type }}</span>
                        </div>
                        <h5 class="font-bold text-gray-800 mb-2">{{ $resource->title }}</h5>
                        <p class="text-muted small mb-3">Subject: <span class="text-teal-700 font-semibold">{{ $resource->subject->name }}</span></p>
                        <p class="text-gray-500 small line-clamp-2 mb-4">{{ $resource->description }}</p>
                        <div class="d-flex gap-2">
                            @if($resource->file_path)
                                <a href="#" class="btn btn-sm btn-teal flex-grow-1 rounded-lg">Download</a>
                            @endif
                            @if($resource->url)
                                <a href="{{ $resource->url }}" target="_blank" class="btn btn-sm btn-outline-teal flex-grow-1 rounded-lg">Open Link</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-20 bg-white rounded-xl shadow-sm">
                <i class="fas fa-folder-open fa-4x text-gray-200 mb-4"></i>
                <p class="text-gray-500">No resources found matching your criteria.</p>
                <a href="{{ route('public.resources.index') }}" class="btn btn-sm btn-teal mt-2">View All Resources</a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8 d-flex justify-content-center">
        {{ $resources->appends(request()->query())->links() }}
    </div>

    <!-- Contribution Box -->
    <div class="mt-12 bg-teal-900 text-white p-8 rounded-2xl shadow-lg relative overflow-hidden">
        <div class="relative z-10">
            <h3 class="text-xl font-bold mb-2">Teacher's Corner</h3>
            <p class="opacity-80 mb-0">You can contribute your teaching materials to help the eMaS community grow. Contact our support team to get verified as a contributor.</p>
        </div>
        <div class="absolute top-0 right-0 p-4 opacity-10">
            <i class="fas fa-hands-helping text-9xl"></i>
        </div>
    </div>
</div>

<style>
    .btn-teal {
        background-color: #0d9488;
        color: white;
        border: none;
    }
    .btn-teal:hover {
        background-color: #0f766e;
        color: white;
    }
    .btn-outline-teal {
        color: #0d9488;
        border-color: #0d9488;
    }
    .btn-outline-teal:hover {
        background-color: #0d9488;
        color: white;
    }
    .feature-card {
        transition: all 0.3s ease;
        border-top: 4px solid transparent;
    }
    .feature-card:hover {
        transform: translateY(-5px);
        border-top-color: #0d9488;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }
    .w-12 { width: 3rem; }
    .h-12 { height: 3rem; }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
