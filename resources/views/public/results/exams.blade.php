@extends('layouts.public')

@section('title', 'Select Exam - ' . $school->name)

@section('content')
<div class="container py-5">
    <div class="mb-8">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item"><a href="{{ route('public.results.index') }}" class="text-teal-600">Academic Years</a></li>
                <li class="breadcrumb-item"><a href="{{ route('public.results.schools', $year) }}" class="text-teal-600">{{ $year }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $school->name }}</li>
            </ol>
        </nav>
        <h2 class="text-3xl font-bold text-teal-900 mt-4">Available Exams</h2>
        <p class="text-gray-600">Select an examination to view published results for {{ $school->name }}.</p>
    </div>

    <div class="row">
        @forelse($exams as $exam)
            <div class="col-md-6 col-lg-4 mb-4">
                <a href="{{ route('public.results.view', ['year' => $year, 'school' => $school->id, 'exam' => $exam->id]) }}" class="text-decoration-none">
                    <div class="card h-100 shadow-sm border-0 border-left-teal transition hover-lift">
                        <div class="card-body p-4">
                            <h5 class="font-weight-bold text-gray-800 mb-2">{{ $exam->name }}</h5>
                            <p class="text-muted small mb-0">
                                <i class="fas fa-calendar-day mr-1"></i> {{ $year }} Academic Year
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12 text-center py-20 bg-white rounded-xl shadow-sm">
                <i class="fas fa-file-invoice fa-4x text-gray-200 mb-4"></i>
                <p class="text-gray-500">No examination results found for this school.</p>
            </div>
        @endforelse
    </div>
</div>

<style>
    .border-left-teal { border-left: 4px solid #0d9488 !important; }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important;
    }
    .transition { transition: all 0.3s ease; }
</style>
@endsection
