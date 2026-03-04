@extends('adminlte::page')

@section('title', 'Import Subjects')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="text-success font-weight-bold mb-0">Import Subjects</h1>
            <small class="text-muted">Select subjects from the system to add to your school</small>
        </div>
        <div>
            <a href="{{ route('user.subjects.index') }}" class="btn btn-secondary shadow-sm">
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
                            <i class="fas fa-file-import mr-1 text-success"></i> Select subjects to import
                        </h3>
                        <div class="small text-muted mt-1">
                            Choose one or more subjects below. Imported subjects will be added to your school.
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

                <form action="{{ route('user.subjects.import.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        @if($subjects->isEmpty())
                            <div class="text-center py-5">
                                <i class="fas fa-check-circle fa-3x mb-3 text-success"></i>
                                <p class="text-muted mb-0">All available subjects have already been imported to your school.</p>
                            </div>
                        @else
                            @php
                                $perColumn = (int) ceil($subjects->count() / 2);
                                $columns = $subjects->chunk($perColumn);
                            @endphp

                            <div class="row">
                                @foreach($columns as $col)
                                    <div class="col-md-6">
                                        <div class="list-group list-group-flush">
                                            @foreach($col as $subject)
                                                @php
                                                    $isImported = in_array($subject->id, $importedSubjectIds);
                                                @endphp
                                                <label class="list-group-item d-flex align-items-center subject-item {{ $isImported ? 'faint-item' : '' }}">
                                                    <input type="checkbox" name="subject_ids[]" value="{{ $subject->id }}" 
                                                           class="mr-3 subject-checkbox" {{ $isImported ? 'disabled checked' : '' }}>
                                                    <div class="flex-grow-1">
                                                        <div class="font-weight-bold {{ $isImported ? 'text-muted' : 'text-dark' }}">
                                                            {{ $subject->code }} - {{ $subject->name }}
                                                            @if($isImported)
                                                                <span class="badge badge-secondary ml-2">Imported</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    @if(!$subjects->isEmpty())
                        <div class="card-footer bg-white">
                            <button type="submit" class="btn btn-success font-weight-bold shadow-sm" id="btnImport" disabled>
                                <i class="fas fa-download mr-1"></i> Import Selected Subjects
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
                        Import subjects used by your school first.
                        After import, go to <strong>Assign Subjects</strong> to link subjects to specific classes.
                    </p>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function () {
            var $newCheckboxes = $('.subject-checkbox:not(:disabled)');
            var $selectedCount = $('#selectedCount');
            var $btnImport = $('#btnImport');

            function updateSelectedUI() {
                var count = $newCheckboxes.filter(':checked').length;
                $selectedCount.text(count);
                if ($btnImport.length) {
                    $btnImport.prop('disabled', count === 0);
                }
            }

            $('#btnSelectAll').on('click', function () {
                $newCheckboxes.prop('checked', true);
                updateSelectedUI();
            });

            $('#btnDeselectAll').on('click', function () {
                $newCheckboxes.prop('checked', false);
                updateSelectedUI();
            });

            $(document).on('change', '.subject-checkbox', function () {
                updateSelectedUI();
            });

            updateSelectedUI();
        });
    </script>
@stop

@section('css')
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
        .subject-item { border-left: 0; border-right: 0; }
        .subject-item:hover:not(.faint-item) { background: #f8fafc; }
        .subject-item input[type="checkbox"] { transform: scale(1.05); }
        .faint-item { opacity: 0.6; background-color: #fcfcfc; cursor: not-allowed; }
    </style>
@stop
