@extends('adminlte::page')

@section('title', 'Academic Settings')

@section('content_header')
    <h1 class="text-success font-weight-bold">Academic Settings</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold"><i class="fas fa-calendar-alt mr-1"></i> Academic Years</h3>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning mb-3">
                        <div class="d-flex">
                            <div class="mr-2"><i class="fas fa-exclamation-triangle"></i></div>
                            <div>
                                <div class="font-weight-bold">Important:</div>
                                <div class="small">
                                    Changing the current academic year may affect student class placements.
                                    Ensure you understand the impact before proceeding.
                                </div>
                            </div>
                        </div>
                    </div>

                    <form id="academic-year-form" action="{{ route('user.academic.years.current.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="confirm" id="confirm-academic-year" value="0">
                        <div class="form-group">
                            <label>Current Academic Year</label>
                            <select name="academic_year_id" class="form-control" required>
                                <option value="" disabled {{ optional($currentAcademicYear)->id ? '' : 'selected' }}>-- Select Academic Year --</option>
                                @foreach($academicYears as $year)
                                    <option value="{{ $year->id }}" {{ optional($currentAcademicYear)->id === $year->id ? 'selected' : '' }}>
                                        {{ $year->name }} {{ $year->is_current ? '(Current)' : '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('academic_year_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        @error('confirm')
                            <div class="text-danger small mb-2">{{ $message }}</div>
                        @enderror

                        <button type="button" id="open-academic-year-confirm" class="btn btn-warning btn-block shadow-sm text-dark font-weight-bold">
                            Update Current Year
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold"><i class="fas fa-clock mr-1"></i> Academic Terms</h3>
                </div>
                <div class="card-body">
                    <form id="academic-term-form" action="{{ route('user.academic.terms.current.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="confirm_term" id="confirm-academic-term" value="0">
                        <div class="form-group">
                            <label>Current Term</label>
                            <select name="term_id" class="form-control" required>
                                <option value="" disabled {{ optional($currentTerm)->id ? '' : 'selected' }}>-- Select Term --</option>
                                @foreach($terms as $term)
                                    <option value="{{ $term->id }}" {{ optional($currentTerm)->id === $term->id ? 'selected' : '' }}>
                                        {{ $term->name }} {{ $term->is_current ? '(Current)' : '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('term_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        @error('confirm_term')
                            <div class="text-danger small mb-2">{{ $message }}</div>
                        @enderror

                        <button type="button" id="open-academic-term-confirm" class="btn btn-warning btn-block shadow-sm text-dark font-weight-bold">
                            Update Current Term
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmAcademicYearModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-dark font-weight-bold">Confirm Academic Year Change</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <div class="font-weight-bold mb-1">This action can impact your students:</div>
                        <div class="small">
                            Students may be moved to the next class based on your school setup.
                            Final-year students can be stored in history for that year and may not appear in the active list.
                        </div>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="academic-year-confirm-checkbox">
                        <label class="custom-control-label" for="academic-year-confirm-checkbox">
                            I understand the impact and want to update the current academic year.
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" id="confirm-academic-year-submit" class="btn btn-warning text-dark font-weight-bold" disabled>
                        Confirm & Update
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmAcademicTermModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-dark font-weight-bold">Confirm Term Change</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning mb-3">
                        <div class="small">
                            This will update the current term for your school. Only <strong>Term 1</strong> and <strong>Term 2</strong> are supported.
                        </div>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="academic-term-confirm-checkbox">
                        <label class="custom-control-label" for="academic-term-confirm-checkbox">
                            I confirm to update the current term.
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" id="confirm-academic-term-submit" class="btn btn-warning text-dark font-weight-bold" disabled>
                        Confirm & Update
                    </button>
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

@section('js')
    <script>
        $(function () {
            var $openBtn = $('#open-academic-year-confirm');
            var $modal = $('#confirmAcademicYearModal');
            var $checkbox = $('#academic-year-confirm-checkbox');
            var $submitBtn = $('#confirm-academic-year-submit');
            var $confirmField = $('#confirm-academic-year');
            var $form = $('#academic-year-form');

            $openBtn.on('click', function () {
                $checkbox.prop('checked', false);
                $submitBtn.prop('disabled', true);
                $confirmField.val('0');
                $modal.modal('show');
            });

            $checkbox.on('change', function () {
                $submitBtn.prop('disabled', !$checkbox.is(':checked'));
            });

            $submitBtn.on('click', function () {
                $confirmField.val('1');
                $form.trigger('submit');
            });

            var $openTermBtn = $('#open-academic-term-confirm');
            var $termModal = $('#confirmAcademicTermModal');
            var $termCheckbox = $('#academic-term-confirm-checkbox');
            var $termSubmitBtn = $('#confirm-academic-term-submit');
            var $termConfirmField = $('#confirm-academic-term');
            var $termForm = $('#academic-term-form');

            $openTermBtn.on('click', function () {
                $termCheckbox.prop('checked', false);
                $termSubmitBtn.prop('disabled', true);
                $termConfirmField.val('0');
                $termModal.modal('show');
            });

            $termCheckbox.on('change', function () {
                $termSubmitBtn.prop('disabled', !$termCheckbox.is(':checked'));
            });

            $termSubmitBtn.on('click', function () {
                $termConfirmField.val('1');
                $termForm.trigger('submit');
            });
        });
    </script>
@stop
