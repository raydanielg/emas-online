@extends('adminlte::page')

@section('title', 'Teachers Performance')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-success font-weight-bold mb-0">Teachers Performance</h1>
        <div class="small text-muted">Academic Analysis per Teacher</div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-white">
                    <form method="GET" action="{{ route('user.teachers.performance') }}" class="form-inline">
                        <div class="form-group mr-3">
                            <label class="mr-2 small font-weight-bold">Year:</label>
                            <select name="year" class="form-control form-control-sm" onchange="this.form.submit()">
                                @foreach($years as $year)
                                    <option value="{{ $year->name }}" {{ $selectedYear == $year->name ? 'selected' : '' }}>{{ $year->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mr-3">
                            <label class="mr-2 small font-weight-bold">Term:</label>
                            <select name="term" class="form-control form-control-sm" onchange="this.form.submit()">
                                @foreach($terms as $term)
                                    <option value="{{ $term->name }}" {{ $selectedTerm == $term->name ? 'selected' : '' }}>{{ $term->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" class="btn btn-default btn-sm ml-auto" onclick="window.print()">
                            <i class="fas fa-print mr-1"></i> Print Report
                        </button>
                    </form>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Teacher Name</th>
                                <th>Initials</th>
                                <th class="text-center">Results Recorded</th>
                                <th class="text-center">Average Score</th>
                                <th>Performance Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($teacherPerformance as $perf)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="font-weight-bold">{{ $perf->name }}</td>
                                    <td><span class="badge badge-secondary">{{ $perf->initials }}</span></td>
                                    <td class="text-center">{{ $perf->total_results }}</td>
                                    <td class="text-center">
                                        <span class="font-weight-bold text-lg {{ $perf->average_score >= 50 ? 'text-success' : 'text-danger' }}">
                                            {{ number_format($perf->average_score, 1) }}%
                                        </span>
                                    </td>
                                    <td>
                                        @if($perf->total_results == 0)
                                            <span class="text-muted italic">No data</span>
                                        @elseif($perf->average_score >= 75)
                                            <span class="badge badge-success px-3">Excellent</span>
                                        @elseif($perf->average_score >= 50)
                                            <span class="badge badge-primary px-3">Good</span>
                                        @else
                                            <span class="badge badge-danger px-3">Needs Improvement</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="fas fa-chart-line fa-3x mb-3"></i>
                                        <p>No performance data found for the selected period.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
        .italic { font-style: italic; }
        @media print {
            .card-header form { display: none; }
            .main-footer, .content-header { display: none; }
        }
    </style>
@stop
