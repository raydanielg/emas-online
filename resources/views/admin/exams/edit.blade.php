@extends('adminlte::page')

@section('title', 'Edit Exam - ' . $exam->name)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Edit Exam</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item small"><a href="{{ route('dashboard') }}">dashboard</a></li>
                <li class="breadcrumb-item small"><a href="{{ route('exams.index') }}">exams</a></li>
                <li class="breadcrumb-item small active" aria-current="page">edit</li>
            </ol>
        </nav>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-outline card-success shadow-sm">
                <form action="{{ route('exams.update', $exam) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Exam Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $exam->name) }}" required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Exam Type <span class="text-danger">*</span></label>
                                    <select name="type" class="form-control @error('type') is-invalid @enderror" id="type" required>
                                        <option value="Midterm" {{ old('type', $exam->type) == 'Midterm' ? 'selected' : '' }}>Mid-Term</option>
                                        <option value="Terminal" {{ old('type', $exam->type) == 'Terminal' ? 'selected' : '' }}>Terminal</option>
                                        <option value="Annual" {{ old('type', $exam->type) == 'Annual' ? 'selected' : '' }}>Annual</option>
                                        <option value="Mock" {{ old('type', $exam->type) == 'Mock' ? 'selected' : '' }}>Mock</option>
                                        <option value="National" {{ old('type', $exam->type) == 'National' ? 'selected' : '' }}>National</option>
                                        <option value="Regional" {{ old('type', $exam->type) == 'Regional' ? 'selected' : '' }}>Regional</option>
                                        <option value="Other" {{ old('type', $exam->type) == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('type')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="academic_year_id">Academic Year <span class="text-danger">*</span></label>
                                    <select name="academic_year_id" class="form-control @error('academic_year_id') is-invalid @enderror" id="academic_year_id" required>
                                        @foreach($academicYears as $year)
                                            <option value="{{ $year->id }}" {{ old('academic_year_id', $exam->academic_year_id) == $year->id ? 'selected' : '' }}>{{ $year->year }}</option>
                                        @endforeach
                                    </select>
                                    @error('academic_year_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="term">Term <span class="text-danger">*</span></label>
                                    <input type="text" name="term" class="form-control @error('term') is-invalid @enderror" id="term" value="{{ old('term', $exam->term) }}" required>
                                    @error('term')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="school_id">Assign to School (Optional)</label>
                                    <select name="school_id" class="form-control select2 @error('school_id') is-invalid @enderror" id="school_id">
                                        <option value="">Global Exam (Regional/National)</option>
                                        @foreach($schools as $school)
                                            <option value="{{ $school->id }}" {{ old('school_id', $exam->school_id) == $school->id ? 'selected' : '' }}>{{ $school->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('school_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" value="{{ old('start_date', $exam->start_date ? $exam->start_date->format('Y-m-d') : '') }}">
                                    @error('start_date')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" value="{{ old('end_date', $exam->end_date ? $exam->end_date->format('Y-m-d') : '') }}">
                                    @error('end_date')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                        <input type="hidden" name="is_active" value="0">
                                        <input type="checkbox" name="is_active" class="custom-control-input" id="is_active" value="1" {{ old('is_active', $exam->is_active) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_active">Exam Active</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                        <input type="hidden" name="is_published" value="0">
                                        <input type="checkbox" name="is_published" class="custom-control-input" id="is_published" value="1" {{ old('is_published', $exam->is_published) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_published">Publish Results</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description (Optional)</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="3">{{ old('description', $exam->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <button type="submit" class="btn btn-success font-weight-bold px-4 shadow-sm">
                            <i class="fas fa-save mr-1"></i> Update Exam
                        </button>
                        <a href="{{ route('exams.index') }}" class="btn btn-default font-weight-bold px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .card-success.card-outline { border-top: 3px solid #0d9488; }
    </style>
@stop
