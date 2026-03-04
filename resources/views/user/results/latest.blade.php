@extends('adminlte::page')

@section('title', 'Latest Results')

@section('content_header')
    <div>
        <h1 class="text-success font-weight-bold mb-0">Latest Uploaded Results</h1>
        <small class="text-muted">Most recent examination results uploaded for your school</small>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ number_format($kpis['total_results'] ?? 0) }}</h3>
                    <p>Total Result Records</p>
                </div>
                <div class="icon">
                    <i class="fas fa-poll"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-12">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $kpis['last_upload'] ? $kpis['last_upload']->diffForHumans() : 'No uploads' }}</h3>
                    <p>Last Uploaded</p>
                </div>
                <div class="icon">
                    <i class="fas fa-cloud-upload-alt"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Recent Results</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Student</th>
                                    <th>Subject</th>
                                    <th>Exam</th>
                                    <th class="text-center">Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($results as $result)
                                    <tr>
                                        <td>{{ $result->created_at->format('d M Y H:i') }}</td>
                                        <td>{{ $result->student->full_name ?? 'N/A' }}</td>
                                        <td>{{ $result->subject->name ?? 'N/A' }}</td>
                                        <td>{{ $result->exam->name ?? 'N/A' }}</td>
                                        <td class="text-center font-weight-bold">{{ $result->score }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <i class="fas fa-file-invoice fa-3x mb-3"></i>
                                            <p class="mb-0">No results found for your school.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    {{ $results->links() }}
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
        .bg-warning { background-color: #ffc107 !important; }
    </style>
@stop
