@extends('adminlte::page')

@section('title', 'Manage Students')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="text-dark font-weight-bold mb-0">Manage Students</h1>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Students</li>
            </ol>
        </nav>
    </div>
@stop

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 border-bottom-0">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <form action="{{ route('user.students.manage') }}" method="GET" class="input-group">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Search by name or admission number...">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-outline-secondary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-9 text-right">
                    <div class="d-inline-flex align-items-center">
                        <form action="{{ route('user.students.manage') }}" method="GET" class="mr-2">
                            <select name="class_level" onchange="this.form.submit()" class="form-control form-control-sm custom-select">
                                <option value="">Filter by Class</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class }}" {{ request('class_level') == $class ? 'selected' : '' }}>{{ $class }}</option>
                                @endforeach
                            </select>
                        </form>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-success mr-1 rounded-0" style="background-color: #28a745; border-color: #28a745;">Print Out</button>
                            <button class="btn btn-sm btn-success mr-1 rounded-0" style="background-color: #28a745; border-color: #28a745;">Re-assign Numbers</button>
                            <a href="{{ route('user.students.create') }}" class="btn btn-sm btn-success rounded-0" style="background-color: #28a745; border-color: #28a745;">Add New Student</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 student-table border-top">
                    <thead>
                        <tr class="text-primary border-bottom bg-light">
                            <th style="width: 40px;"><input type="checkbox" id="selectAll"></th>
                            <th class="font-weight-bold text-uppercase small text-blue-custom">Admission Number</th>
                            <th class="font-weight-bold text-uppercase small text-blue-custom">Full Name</th>
                            <th class="font-weight-bold text-uppercase small text-blue-custom">Sex</th>
                            <th class="font-weight-bold text-uppercase small text-blue-custom">Class</th>
                            <th class="font-weight-bold text-uppercase small text-blue-custom">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr class="{{ $loop->even ? 'bg-light' : '' }}">
                                <td class="px-3"><input type="checkbox" class="student-checkbox"></td>
                                <td class="text-muted px-3">{{ $student->admission_number }}</td>
                                <td class="font-weight-bold text-dark text-uppercase px-3">{{ $student->full_name }}</td>
                                <td class="text-muted px-3">{{ $student->gender == 'Male' ? 'M' : 'F' }}</td>
                                <td class="text-muted text-uppercase px-3">{{ $student->class_level }}</td>
                                <td class="px-3">
                                    <div class="btn-group">
                                        <a href="{{ route('user.students.edit', $student) }}" class="btn btn-xs btn-outline-warning mx-1 border-0" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('user.students.destroy', $student) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this student?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-outline-danger border-0" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <p class="text-muted mb-0">No students found matching your criteria.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-top-0 clearfix">
            <div class="float-right mt-2">
                {{ $students->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .student-table thead th {
            border-top: 0;
            padding: 15px 15px;
            color: #4a69bd !important;
            letter-spacing: 0.5px;
            font-size: 13px;
        }
        .text-blue-custom {
            color: #1e3799 !important;
        }
        .student-table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
            border-top: 1px solid #eeeeee;
            font-size: 14px;
        }
        .breadcrumb-item + .breadcrumb-item::before {
            content: "/";
            color: #6c757d;
        }
        .bg-light {
            background-color: #f9f9f9 !important;
        }
        .custom-select {
            height: calc(1.8125rem + 2px);
            padding-top: 0.25rem;
            padding-bottom: 0.25rem;
            padding-left: 0.5rem;
            font-size: 0.875rem;
            border-radius: 0;
        }
        .rounded-0 {
            border-radius: 0 !important;
        }
    </style>
@stop

@section('js')
    <script>
        $(function () {
            $('#selectAll').on('click', function() {
                $('.student-checkbox').prop('checked', this.checked);
            });
        });
    </script>
@stop
