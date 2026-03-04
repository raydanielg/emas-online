@extends('adminlte::page')

@section('title', 'Add New Result')

@section('content_header')
    <h1 class="text-success font-weight-bold">Add Student Result</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Result Details</h3>
                </div>
                <form action="{{ route('results.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="student_id">Select Student</label>
                                <select name="student_id" class="form-control select2" required>
                                    <option value="">-- Select --</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->admission_number }} - {{ $student->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="subject_id">Select Subject</label>
                                <select name="subject_id" class="form-control select2" required>
                                    <option value="">-- Select --</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->code }} - {{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="school_id">School</label>
                                <select name="school_id" class="form-control" required>
                                    <option value="">-- Select --</option>
                                    @foreach($schools as $school)
                                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="score">Score (%)</label>
                                <input type="number" name="score" class="form-control" step="0.01" min="0" max="100" placeholder="e.g. 85.5" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="term">Term</label>
                                <select name="term" class="form-control" required>
                                    <option value="Term 1">Term 1</option>
                                    <option value="Term 2">Term 2</option>
                                    <option value="Annual">Annual</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="year">Year</label>
                                <input type="number" name="year" class="form-control" value="{{ date('Y') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-right">
                        <a href="{{ route('results.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-warning shadow-sm">Save Result</button>
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
