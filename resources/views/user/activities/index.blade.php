@extends('adminlte::page')

@section('title', 'Recent Activities')

@section('content_header')
    <div>
        <h1 class="text-success font-weight-bold mb-0">Recent Activities</h1>
        <small class="text-muted">Login and system activities for your school staff</small>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ number_format($kpis['total_logs'] ?? 0) }}</h3>
                    <p>Total Activity Logs</p>
                </div>
                <div class="icon">
                    <i class="fas fa-history"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-12">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $kpis['last_activity'] ? \Carbon\Carbon::parse($kpis['last_activity'])->diffForHumans() : 'No activity' }}</h3>
                    <p>Last Activity Detected</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Activity Log</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Time</th>
                                    <th>User</th>
                                    <th>IP Address</th>
                                    <th>User Agent</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($activities as $activity)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($activity->login_at)->format('d M Y H:i') }}</td>
                                        <td>{{ $activity->user->name ?? 'N/A' }}</td>
                                        <td><code>{{ $activity->ip_address }}</code></td>
                                        <td class="small text-muted">{{ Str::limit($activity->user_agent, 50) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted">
                                            <i class="fas fa-user-clock fa-3x mb-3"></i>
                                            <p class="mb-0">No recent activities recorded.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    {{ $activities->links() }}
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
