@extends('adminlte::page')

@section('title', 'Website Frontend Settings')

@section('content_header')
    <h1 class="text-success font-weight-bold">Website Frontend Settings</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold"><i class="fas fa-desktop mr-1"></i> Landing Page Content</h3>
                </div>
                <form action="#" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Hero Title</label>
                            <input type="text" class="form-control" value="Welcome to EMAS School Portal">
                        </div>
                        <div class="form-group">
                            <label>Hero Subtitle</label>
                            <textarea class="form-control" rows="2">Managing schools, students, and results has never been easier.</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Show News Section</label>
                                <select class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Enable Registrations</label>
                                <select class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-right">
                        <button type="submit" class="btn btn-warning shadow-sm">Save Frontend Changes</button>
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
