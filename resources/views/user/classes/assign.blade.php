@extends('adminlte::page')

@section('title', 'Import Classes')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="text-success font-weight-bold mb-0">Import Classes</h1>
            <small class="text-muted">Select classes from the system to add to your school</small>
        </div>
        <div>
            <a href="{{ route('user.classes.index') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left mr-1"></i> Back
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="card-title text-dark mb-0">
                            <i class="fas fa-file-import mr-1 text-success"></i> Select classes to import
                        </h3>
                        <div class="small text-muted mt-1">
                            Choose one or more classes below. Imported classes will be added to your school.
                            <span class="ml-2">Selected: <span id="selectedCount" class="font-weight-bold">0</span></span>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="button" id="btnSelectAll" class="btn btn-outline-secondary btn-sm">
                            <i class="far fa-check-square mr-1"></i> Select all
                        </button>
                        <button type="button" id="btnDeselectAll" class="btn btn-outline-secondary btn-sm">
                            <i class="far fa-square mr-1"></i> Deselect all
                        </button>
                    </div>
                </div>

                <form action="{{ route('user.classes.assign.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        @if($globalClasses->isEmpty())
                            <div class="text-center py-5">
                                <i class="fas fa-check-circle fa-3x mb-3 text-success"></i>
                                <p class="text-muted mb-0">All available classes have been added to your school.</p>
                            </div>
                        @else
                            @php
                                $perColumn = (int) ceil($globalClasses->count() / 2);
                                $columns = $globalClasses->chunk($perColumn);
                            @endphp

                            <div class="row">
                                @foreach($columns as $col)
                                    <div class="col-md-6">
                                        <div class="list-group list-group-flush">
                                            @foreach($col as $class)
                                                <label class="list-group-item d-flex align-items-center class-item">
                                                    <input type="checkbox" name="global_class_ids[]" value="{{ $class->id }}" class="mr-3 class-checkbox">
                                                    <div class="flex-grow-1">
                                                        <div class="font-weight-bold text-dark">{{ $class->name }}</div>
                                                        <div class="small text-muted">Level: {{ $class->level }}</div>
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    @if(!$globalClasses->isEmpty())
                        <div class="card-footer bg-white">
                            <button type="submit" class="btn btn-success font-weight-bold shadow-sm" id="btnImport" disabled>
                                <i class="fas fa-download mr-1"></i> Import Selected Classes
                            </button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-outline card-info shadow-sm">
                <div class="card-header bg-white">
                    <h3 class="card-title text-dark">
                        <i class="fas fa-info-circle mr-1 text-info"></i> Guide
                    </h3>
                </div>
                <div class="card-body">
                    <p class="small text-muted mb-0">
                        Choose the classes that exist in your school for this academic year. 
                        Once imported, you can manage students and marks for these classes.
                    </p>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function () {
            var $checkboxes = $('.class-checkbox');
            var $selectedCount = $('#selectedCount');
            var $btnImport = $('#btnImport');

            function updateSelectedUI() {
                var count = $checkboxes.filter(':checked').length;
                $selectedCount.text(count);
                if ($btnImport.length) {
                    $btnImport.prop('disabled', count === 0);
                }
            }

            $('#btnSelectAll').on('click', function () {
                $checkboxes.prop('checked', true);
                updateSelectedUI();
            });

            $('#btnDeselectAll').on('click', function () {
                $checkboxes.prop('checked', false);
                updateSelectedUI();
            });

            $(document).on('change', '.class-checkbox', function () {
                updateSelectedUI();
            });

            updateSelectedUI();
        });
    </script>
@stop

@section('css')
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
        .class-item { border-left: 0; border-right: 0; }
        .class-item:hover { background: #f8fafc; }
        .class-item input[type="checkbox"] { transform: scale(1.05); }
    </style>
@stop
