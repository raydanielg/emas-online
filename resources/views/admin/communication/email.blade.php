@extends('adminlte::page')

@section('title', 'Send Email')

@section('content_header')
    <h1 class="text-success font-weight-bold">Send Email Notification</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold"><i class="fas fa-envelope mr-1"></i> Compose Email</h3>
                </div>
                <form action="#" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Recipients</label>
                            <select class="form-control select2" name="recipients[]" multiple="multiple" data-placeholder="Select Schools, Users or Groups" style="width: 100%;">
                                <option>All Admin Users</option>
                                <option>All School Managers</option>
                                <option>All Registered Schools</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" name="subject" class="form-control" id="subject" placeholder="Enter email subject" required>
                        </div>
                        <div class="form-group">
                            <label for="content">Message Content</label>
                            <textarea name="content" id="content" class="form-control" rows="10" placeholder="Type your message here..." required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="attachment">Attachment (Optional)</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="attachment">
                                <label class="custom-file-label" for="attachment">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-right">
                        <button type="submit" class="btn btn-warning shadow-sm"><i class="fas fa-paper-plane mr-1"></i> Send Email</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });
        });
    </script>
@stop

@section('css')
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
    </style>
@stop
