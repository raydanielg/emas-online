@extends('adminlte::page')

@section('title', 'Login History')

@section('content_header')
    <h1 class="text-success font-weight-bold">User Login History</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold"><i class="fas fa-history mr-1"></i> System Access Logs</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="bg-dark">
                            <tr>
                                <th>User</th>
                                <th>IP Address</th>
                                <th>User Agent</th>
                                <th>Login Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                                <tr>
                                    <td>{{ $log->user->name ?? 'Unknown' }} ({{ $log->user->email ?? 'N/A' }})</td>
                                    <td><span class="badge badge-info">{{ $log->ip_address }}</span></td>
                                    <td><small>{{ Str::limit($log->user_agent, 50) }}</small></td>
                                    <td>{{ $log->login_at ? \Carbon\Carbon::parse($log->login_at)->format('d M, Y H:i:s') : $log->created_at->format('d M, Y H:i:s') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">No login records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white">
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>
@stop
