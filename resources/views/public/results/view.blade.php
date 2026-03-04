@extends('layouts.public')

@section('title', 'Examination Results')

@section('content')
<div class="container py-5">
    <div class="mb-8">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item"><a href="{{ route('public.results.index') }}" class="text-teal-600">Academic Years</a></li>
                <li class="breadcrumb-item"><a href="{{ route('public.results.schools', $year) }}" class="text-teal-600">{{ $year }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('public.results.exams', [$year, $school->id]) }}" class="text-teal-600">{{ $school->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $exam->name }}</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between align-items-end mt-4">
            <div>
                <h2 class="text-3xl font-bold text-teal-900">{{ $exam->name }} Results</h2>
                <p class="text-gray-600 mb-0">{{ $school->name }} - {{ $year }} Academic Year</p>
            </div>
            <button onclick="window.print()" class="btn btn-outline-teal d-none d-md-block">
                <i class="fas fa-print mr-1"></i> Print Results
            </button>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light border-bottom">
                        <tr class="text-teal-800">
                            <th class="px-4 py-3">S/N</th>
                            <th class="py-3">Candidate Name</th>
                            <th class="py-3">Subject</th>
                            <th class="text-center py-3">Score</th>
                            <th class="text-center py-3">Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($results as $index => $result)
                            <tr class="border-bottom">
                                <td class="px-4 py-3 text-muted">{{ $index + 1 }}</td>
                                <td class="py-3 font-weight-bold text-dark text-uppercase">{{ $result->student->full_name ?? 'N/A' }}</td>
                                <td class="py-3">{{ $result->subject->name ?? 'N/A' }}</td>
                                <td class="text-center py-3 font-weight-bold">{{ $result->score }}</td>
                                <td class="text-center py-3">
                                    <span class="badge badge-pill px-3 py-2 bg-teal-50 text-teal-700 border border-teal-100">
                                        {{ $result->grade ?? 'N/A' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-info-circle fa-2x mb-3 opacity-20"></i>
                                    <p class="mb-0">No result details available for this selection.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .text-teal-900 { color: #134e4a; }
    .text-teal-800 { color: #115e59; }
    .text-teal-700 { color: #0f766e; }
    .text-teal-600 { color: #0d9488; }
    .btn-outline-teal {
        color: #0d9488;
        border-color: #0d9488;
    }
    .btn-outline-teal:hover {
        background-color: #0d9488;
        color: white;
    }
    .bg-teal-50 { background-color: #f0fdfa; }
    @media print {
        .breadcrumb, .btn-outline-teal { display: none !important; }
        .card { border: 0 !important; box-shadow: none !important; }
    }
</style>
@endsection
