@extends('adminlte::page')

@section('title', 'Edit Result')

@section('content_header')
    <h1>Edit Student Result</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Update Result Details</h3>
                </div>
                <form action="{{ route('results.update', $result) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="student_id">Student</label>
                                <select name="student_id" class="form-control select2" required>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}" {{ $result->student_id == $student->id ? 'selected' : '' }}>
                                            {{ $student->admission_number }} - {{ $student->full_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="subject_id">Subject</label>
                                <select name="subject_id" class="form-control select2" required>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ $result->subject_id == $subject->id ? 'selected' : '' }}>
                                            {{ $subject->code }} - {{ $subject->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="school_id">School</label>
                                <select name="school_id" class="form-control" required>
                                    @foreach($schools as $school)
                                        <option value="{{ $school->id }}" {{ $result->school_id == $school->id ? 'selected' : '' }}>
                                            {{ $school->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="score">Score (%)</label>
                                <input type="number" name="score" class="form-control" step="0.01" min="0" max="100" value="{{ old('score', $result->score) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="term">Term</label>
                                <select name="term" class="form-control" required>
                                    <option value="Term 1" {{ $result->term == 'Term 1' ? 'selected' : '' }}>Term 1</option>
                                    <option value="Term 2" {{ $result->term == 'Term 2' ? 'selected' : '' }}>Term 2</option>
                                    <option value="Annual" {{ $result->term == 'Annual' ? 'selected' : '' }}>Annual</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="year">Year</label>
                                <input type="number" name="year" class="form-control" value="{{ old('year', $result->year) }}" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="draft" {{ $result->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ $result->status == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="locked" {{ $result->status == 'locked' ? 'selected' : '' }}>Locked</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-right">
                        <a href="{{ route('results.index') }}" class="btn btn-secondary mr-2">Cancel</a>
                        <button type="submit" class="btn btn-warning shadow-sm">Update Result</button>
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
        });
    </script>
@stop

@section('css')
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
    </style>
@stop
