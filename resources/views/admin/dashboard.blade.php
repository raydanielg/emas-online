@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@section('content_header')
    <h1>Admin Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>150</h3>
                    <p>Total Schools</p>
                </div>
                <div class="icon">
                    <i class="fas fa-school"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>120</h3>
                    <p>Approved Schools</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>30</h3>
                    <p>Pending Schools</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clock"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>45,000</h3>
                    <p>Total Students</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>

    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>2,500</h3>
                    <p>Total Teachers</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>12</h3>
                    <p>Notifications</p>
                </div>
                <div class="icon">
                    <i class="fas fa-bell"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header">
                    <h3 class="card-title text-dark font-weight-bold">Latest Activities</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Activity</th>
                                <th>User</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>New school registered: "Mlimani Primary"</td>
                                <td>Admin</td>
                                <td>2 mins ago</td>
                            </tr>
                            <tr>
                                <td>Results published for 2023</td>
                                <td>Exams Dept</td>
                                <td>1 hour ago</td>
                            </tr>
                            <tr>
                                <td>User "John Doe" suspended</td>
                                <td>Admin</td>
                                <td>3 hours ago</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-outline card-warning shadow-sm">
                <div class="card-header">
                    <h3 class="card-title text-dark font-weight-bold">System Notifications</h3>
                </div>
                <div class="card-body">
                    <div class="alert alert-info alert-dismissible shadow-sm">
                        <i class="icon fas fa-info-circle"></i> Backup completed successfully.
                    </div>
                    <div class="alert alert-warning alert-dismissible shadow-sm">
                        <i class="icon fas fa-exclamation-triangle"></i> 5 schools awaiting approval.
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .icon-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            font-size: 20px;
        }
        .bg-teal-soft { background-color: #e6fffa; }
        .text-teal { color: #2c7a7b; }
        .bg-blue-soft { background-color: #ebf8ff; }
        .text-blue { color: #2b6cb0; }
        .bg-orange-soft { background-color: #fffaf0; }
        .text-orange { color: #c05621; }
        .bg-purple-soft { background-color: #faf5ff; }
        .text-purple { color: #6b46c1; }
        .feature-box {
            transition: transform 0.2s ease;
            border-top: 3px solid #dee2e6 !important;
        }
        .feature-box:hover {
            transform: translateY(-3px);
            border-top-color: #28a745 !important;
        }
        .text-xs { font-size: 0.75rem; }
    </style>
@stop
