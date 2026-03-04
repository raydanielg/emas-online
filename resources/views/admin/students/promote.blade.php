@extends('adminlte::page')

@section('title', 'Promote Students')

@section('content_header')
    <h1 class="text-success font-weight-bold">Promote Students</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold"><i class="fas fa-level-up-alt mr-1"></i> Bulk Promotion</h3>
                </div>
                <form action="#" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>From Class</label>
                                <select class="form-control" required>
                                    <option value="">-- Select --</option>
                                    <option>Standard 1</option>
                                    <option>Standard 2</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>To Class</label>
                                <select class="form-control" required>
                                    <option value="">-- Select --</option>
                                    <option>Standard 2</option>
                                    <option>Standard 3</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Academic Year</label>
                                <input type="number" class="form-control" value="{{ date('Y') + 1 }}">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-right">
                        <button type="submit" class="btn btn-warning shadow-sm">Process Promotion</button>
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
