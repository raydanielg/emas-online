@extends('adminlte::page')

@section('title', 'Import Students')

@section('content_header')
    <h1 class="text-success font-weight-bold">Import Students (Excel)</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold"><i class="fas fa-file-excel mr-1"></i> Upload Excel File</h3>
                </div>
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="alert alert-info">
                            <h5><i class="icon fas fa-info"></i> Instructions</h5>
                            Pakua template ya Excel kwanza, jaza taarifa za wanafunzi kisha upload hapa.
                            <br><br>
                            <a href="#" class="btn btn-sm btn-dark"><i class="fas fa-download mr-1"></i> Download Template</a>
                        </div>
                        <div class="form-group">
                            <label for="excel_file">Select File</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="excel_file" required>
                                <label class="custom-file-label" for="excel_file">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-right">
                        <button type="submit" class="btn btn-warning shadow-sm">Start Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
@stop

@section('css')
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
    </style>
@stop
