@extends('adminlte::page')

@section('title', 'School Details - ' . $school->name)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>School Details</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item small"><a href="{{ route('dashboard') }}">dashboard</a></li>
                <li class="breadcrumb-item small"><a href="{{ route('schools.index') }}">schools</a></li>
                <li class="breadcrumb-item small active" aria-current="page">{{ strtolower($school->name) }}</li>
            </ol>
        </nav>
    </div>
@stop

@section('content')
    <div class="row">
        <!-- School Info Card -->
        <div class="col-md-4">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-body box-profile">
                    <div class="text-center mb-3">
                        <img class="profile-user-img img-fluid img-circle"
                             src="{{ $school->logo ? asset('storage/' . $school->logo) : 'https://ui-avatars.com/api/?name=' . urlencode($school->name) . '&background=0d9488&color=fff&size=128' }}"
                             alt="School logo"
                             style="width: 100px; height: 100px; object-fit: cover;">
                    </div>

                    <h3 class="profile-username text-center font-weight-bold">{{ $school->name }}</h3>
                    <p class="text-muted text-center small text-uppercase font-weight-bold mb-4">
                        {{ $school->registration_number }}
                    </p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Category</b> <span class="float-right badge badge-info">{{ $school->category }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Level</b> <span class="float-right badge badge-primary">{{ $school->level }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Status</b> 
                            <span class="float-right badge {{ $school->status === 'Approved' ? 'badge-success' : ($school->status === 'Pending' ? 'badge-warning' : 'badge-danger') }}">
                                {{ $school->status }}
                            </span>
                        </li>
                        <li class="list-group-item small">
                            <b>Phone</b> <span class="float-right text-dark">{{ $school->phone ?? 'N/A' }}</span>
                        </li>
                        <li class="list-group-item small">
                            <b>Email</b> <span class="float-right text-dark">{{ $school->email }}</span>
                        </li>
                        <li class="list-group-item small border-bottom-0">
                            <b>Address</b> <span class="float-right text-right text-dark">{{ $school->address ?? 'N/A' }}</span>
                        </li>
                    </ul>

                    <div class="mt-4">
                        <a href="{{ route('schools.edit', $school) }}" class="btn btn-success btn-block shadow-sm">
                            <i class="fas fa-edit mr-1"></i> Edit School Info
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- School Stats & Charts -->
        <div class="col-md-8">
            <!-- Stats Row -->
            <div class="row">
                <div class="col-sm-4">
                    <div class="info-box shadow-sm border-left border-info">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-graduate"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text small">Total Students</span>
                            <span class="info-box-number h5 mb-0">{{ number_format($stats['total_students']) }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="info-box shadow-sm border-left border-success">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-chalkboard-teacher"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text small">Total Teachers</span>
                            <span class="info-box-number h5 mb-0">{{ number_format($stats['total_teachers']) }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="info-box shadow-sm border-left border-warning">
                        <span class="info-box-icon bg-warning elevation-1 text-white"><i class="fas fa-layer-group"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text small">Total Classes</span>
                            <span class="info-box-number h5 mb-0">{{ number_format($stats['total_classes']) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Card -->
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header border-0 bg-transparent">
                    <h3 class="card-title text-dark font-weight-bold">
                        <i class="fas fa-chart-pie mr-1 text-teal"></i>
                        Student Gender Distribution
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 border-right">
                            <div class="chart-responsive">
                                <canvas id="genderPieChart" height="200"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <ul class="chart-legend clearfix mt-4">
                                <li class="mb-3">
                                    <i class="fas fa-circle text-blue mr-2"></i> Male Students: 
                                    <span class="float-right font-weight-bold">{{ $stats['male_students'] }}</span>
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-circle text-pink mr-2"></i> Female Students: 
                                    <span class="float-right font-weight-bold">{{ $stats['female_students'] }}</span>
                                </li>
                                <li class="pt-3 border-top">
                                    <span class="text-muted">Total: </span>
                                    <span class="float-right font-weight-bold h5 mb-0 text-dark">{{ $stats['total_students'] }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description Card -->
            <div class="card card-outline card-success shadow-sm mt-4">
                <div class="card-header bg-transparent border-bottom">
                    <h3 class="card-title text-dark font-weight-bold">
                        <i class="fas fa-info-circle mr-1 text-teal"></i>
                        About the School
                    </h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">
                        {{ $school->description ?? 'No detailed description provided for this school.' }}
                    </p>
                    <hr>
                    <div class="row text-sm mt-3">
                        <div class="col-sm-6">
                            <strong><i class="fas fa-user-shield mr-1 text-success"></i> Registered By</strong>
                            <p class="text-muted">{{ $school->user->name ?? 'System' }}</p>
                        </div>
                        <div class="col-sm-6">
                            <strong><i class="fas fa-calendar-alt mr-1 text-success"></i> Registration Date</strong>
                            <p class="text-muted">{{ $school->created_at->format('d M, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function () {
        // Gender Pie Chart
        const ctx = document.getElementById('genderPieChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Male', 'Female'],
                datasets: [{
                    data: [{{ $stats['male_students'] }}, {{ $stats['female_students'] }}],
                    backgroundColor: ['#2b6cb0', '#ed64a6'],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
@stop

@section('css')
    <style>
        .profile-user-img { border: 3px solid #0d9488; }
        .card-success.card-outline { border-top: 3px solid #0d9488; }
        .text-teal { color: #0d9488; }
        .text-blue { color: #2b6cb0; }
        .text-pink { color: #ed64a6; }
        .border-left { border-left: 4px solid !important; }
        .chart-legend { list-style: none; padding: 0; }
    </style>
@stop
