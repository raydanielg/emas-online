@extends('layouts.public')

@section('title', 'Select School - Results ' . $year)

@section('content')
<div class="container py-5">
    <div class="mb-8">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item"><a href="{{ route('public.results.index') }}" class="text-teal-600">Academic Years</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $year }}</li>
            </ol>
        </nav>
        <h2 class="text-3xl font-bold text-teal-900 mt-4">Schools with Results ({{ $year }})</h2>
        <p class="text-gray-600">Select your school to view available examination results.</p>
    </div>

    <div class="row">
        @forelse($schools as $school)
            <div class="col-md-6 col-lg-4 mb-4">
                <a href="{{ route('public.results.exams', ['year' => $year, 'school' => $school->id]) }}" class="text-decoration-none">
                    <div class="card h-100 shadow-sm border-0 hover-lift transition">
                        <div class="card-body p-4 d-flex align-items-center">
                            <div class="bg-teal-50 p-3 rounded-lg mr-4">
                                <i class="fas fa-school text-teal-600 text-xl"></i>
                            </div>
                            <div>
                                <h5 class="card-title font-weight-bold mb-1 text-gray-800">{{ $school->name }}</h5>
                                <p class="card-text text-muted small mb-0">{{ $school->registration_number }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12 text-center py-20 bg-white rounded-xl shadow-sm">
                <i class="fas fa-school fa-4x text-gray-200 mb-4"></i>
                <p class="text-gray-500">No schools have published results for this year.</p>
            </div>
        @endforelse
    </div>
</div>

<style>
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important;
    }
    .transition { transition: all 0.3s ease; }
</style>
@endsection
