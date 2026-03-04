@extends('layouts.public')

@section('title', 'Academic Years - Results')

@section('content')
<div class="container py-5">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-teal-900 mb-2">Examination Results</h2>
        <p class="text-gray-600">Select an academic year to view published results.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($years as $yearItem)
            <a href="{{ route('public.results.schools', $yearItem->year) }}" class="group">
                <div class="bg-white p-8 rounded-xl shadow-sm border-t-4 border-teal-600 text-center feature-card hover:bg-teal-50 transition">
                    <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-teal-200 transition">
                        <i class="fas fa-calendar-alt text-teal-700 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $yearItem->year }}</h3>
                    <p class="text-teal-600 text-sm font-semibold mt-2">View Results <i class="fas fa-arrow-right ml-1"></i></p>
                </div>
            </a>
        @empty
            <div class="col-span-full text-center py-20 bg-white rounded-xl shadow-sm">
                <i class="fas fa-history fa-4x text-gray-200 mb-4"></i>
                <p class="text-gray-500">No examination results have been published yet.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
