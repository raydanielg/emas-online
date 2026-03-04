@extends('adminlte::page')

@section('title', 'Marks Entry')

@section('content_header')
    <h1 class="text-success font-weight-bold">Marks Management</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold"><i class="fas fa-filter mr-1"></i> Filter Selection</h3>
                </div>
                <div class="card-body">
                    <form action="#" method="GET">
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label>Select Exam</label>
                                <select class="form-control select2">
                                    <option>Midterm 2024</option>
                                    <option>Annual 2024</option>
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Select Class</label>
                                <select class="form-control select2">
                                    <option>Form 1 A</option>
                                    <option>Form 2 B</option>
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Select Subject</label>
                                <select class="form-control select2">
                                    <option>Mathematics</option>
                                    <option>English</option>
                                </select>
                            </div>
                            <div class="col-md-3 form-group d-flex align-items-end">
                                <button type="button" class="btn btn-warning btn-block shadow-sm">Load Students</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-dark">
                    <h3 class="card-title">Enter Marks</h3>
                    <div class="card-tools">
                        <button class="btn btn-sm btn-success"><i class="fas fa-file-excel mr-1"></i> Bulk Upload</button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Admission No</th>
                                <th style="width: 150px;">Score (0-100)</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John Doe</td>
                                <td>ADM/001</td>
                                <td><input type="number" class="form-control form-control-sm" min="0" max="100" placeholder="0.00"></td>
                                <td><input type="text" class="form-control form-control-sm" placeholder="Optional remark"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white text-right">
                    <button class="btn btn-warning shadow-sm"><i class="fas fa-save mr-1"></i> Save Marks</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@stop

@section('css')
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
    </style>
@stop
