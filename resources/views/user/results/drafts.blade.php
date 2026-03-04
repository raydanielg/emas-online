@extends('adminlte::page')

@section('title', 'Result Drafts')

@section('content_header')
    <div>
        <h1 class="text-success font-weight-bold mb-0">Pending Result Drafts</h1>
        <small class="text-muted">Results that are saved as drafts and not yet published</small>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ number_format($kpis['total_drafts'] ?? 0) }}</h3>
                    <p>Total Pending Drafts</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-signature"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-12">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $kpis['oldest_draft'] ? $kpis['oldest_draft']->diffForHumans() : 'No drafts' }}</h3>
                    <p>Oldest Draft Created</p>
                </div>
                <div class="icon">
                    <i class="fas fa-history"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Draft Records</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Created Date</th>
                                    <th>Student</th>
                                    <th>Subject</th>
                                    <th class="text-center">Score</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($drafts as $draft)
                                    <tr>
                                        <td>{{ $draft->created_at->format('d M Y H:i') }}</td>
                                        <td>{{ $draft->student->full_name ?? 'N/A' }}</td>
                                        <td>{{ $draft->subject->name ?? 'N/A' }}</td>
                                        <td class="text-center font-weight-bold">{{ $draft->score }}</td>
                                        <td><span class="badge badge-warning">Draft</span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <i class="fas fa-clipboard-list fa-3x mb-3"></i>
                                            <p class="mb-0">No pending drafts found.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    {{ $drafts->links() }}
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
