@extends('adminlte::page')

@section('title', 'Payments & Subscriptions')

@section('content_header')
    <h1 class="text-success font-weight-bold">Payments & Subscriptions</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-success shadow-sm">
                <span class="info-box-icon"><i class="fas fa-money-check-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Revenue</span>
                    <span class="info-box-number">TZS {{ number_format($payments->where('status', 'successful')->sum('amount'), 2) }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-warning shadow-sm">
                <span class="info-box-icon text-dark"><i class="fas fa-file-invoice-dollar"></i></span>
                <div class="info-box-content text-dark">
                    <span class="info-box-text">Pending Approvals</span>
                    <span class="info-box-number">{{ $payments->where('status', 'pending')->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-outline card-success shadow-sm">
        <div class="card-header bg-warning">
            <h3 class="card-title text-dark font-weight-bold"><i class="fas fa-history mr-1"></i> Recent Transactions</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="bg-dark">
                        <tr>
                            <th>Transaction ID</th>
                            <th>School Name</th>
                            <th>Amount</th>
                            <th>Plan</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $payment)
                            <tr>
                                <td>{{ $payment->transaction_id }}</td>
                                <td>{{ $payment->school->name }}</td>
                                <td>TZS {{ number_format($payment->amount, 2) }}</td>
                                <td>{{ $payment->plan_name }}</td>
                                <td>
                                    <span class="badge badge-{{ $payment->status == 'successful' ? 'success' : ($payment->status == 'pending' ? 'warning text-dark' : 'danger') }}">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </td>
                                <td>{{ $payment->created_at->format('d M, Y') }}</td>
                                <td>
                                    <div class="btn-group">
                                        @if($payment->status == 'pending')
                                            <form action="{{ route('payments.updateStatus', $payment) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="successful">
                                                <button type="submit" class="btn btn-sm btn-success" title="Approve"><i class="fas fa-check"></i></button>
                                            </form>
                                            <form action="{{ route('payments.updateStatus', $payment) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="btn btn-sm btn-danger" title="Reject"><i class="fas fa-times"></i></button>
                                            </form>
                                        @endif
                                        <button class="btn btn-sm btn-info" title="View Details"><i class="fas fa-eye"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center py-4">No transactions found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            {{ $payments->links() }}
        </div>
    </div>
@stop

@section('css')
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
    </style>
@stop
