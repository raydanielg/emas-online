@extends('adminlte::page')

@section('title', 'Send SMS')

@section('content_header')
    <h1 class="text-success font-weight-bold">Send SMS Notification</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold"><i class="fas fa-sms mr-1"></i> Compose SMS</h3>
                </div>
                <form action="#" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Select Recipients</label>
                            <select class="form-control select2" name="recipients[]" multiple="multiple" data-placeholder="Select Schools or Users" style="width: 100%;">
                                <option>All Schools</option>
                                <option>All Teachers</option>
                                <option>All Parents</option>
                                <option>Specific School: Mlimani Primary</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Message Content</label>
                            <textarea name="message" class="form-control" rows="4" placeholder="Type your message here..."></textarea>
                            <small class="text-muted">Characters: <span id="char-count">0</span> / 160 (1 SMS)</small>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-right">
                        <button type="submit" class="btn btn-warning shadow-sm"><i class="fas fa-paper-plane mr-1"></i> Send Bulk SMS</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box bg-success shadow-sm">
                <span class="info-box-icon"><i class="fas fa-wallet"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">SMS Balance</span>
                    <span class="info-box-number">4,250 Units</span>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
    </style>
@stop
