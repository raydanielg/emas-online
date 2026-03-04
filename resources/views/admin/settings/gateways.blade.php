@extends('adminlte::page')

@section('title', 'SMTP & Gateway Settings')

@section('content_header')
    <h1 class="text-success font-weight-bold">Communication Gateways</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold"><i class="fas fa-mail-bulk mr-1"></i> SMTP Configuration</h3>
                </div>
                <form>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Mail Host</label>
                            <input type="text" class="form-control" value="smtp.mailtrap.io">
                        </div>
                        <div class="form-group">
                            <label>Mail Port</label>
                            <input type="text" class="form-control" value="2525">
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" value="********">
                        </div>
                        <div class="form-group">
                            <label>Encryption</label>
                            <select class="form-control">
                                <option>TLS</option>
                                <option>SSL</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <button type="submit" class="btn btn-warning shadow-sm">Save SMTP</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold"><i class="fas fa-sms mr-1"></i> SMS Gateway (Twilio/Infobip)</h3>
                </div>
                <form>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Gateway Provider</label>
                            <select class="form-control">
                                <option>Twilio</option>
                                <option>Infobip</option>
                                <option>Beem SMS</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>API Key</label>
                            <input type="password" class="form-control" value="****************">
                        </div>
                        <div class="form-group">
                            <label>Sender ID</label>
                            <input type="text" class="form-control" value="EMAS_INFO">
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <button type="submit" class="btn btn-warning shadow-sm">Save Gateway</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
    </style>
@stop
