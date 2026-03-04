<?php $__env->startSection('title', 'User Dashboard'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="text-success font-weight-bold">School Overview</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('warning')): ?>
        <div class="alert alert-warning">
            <?php echo e(session('warning')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($school && $school->status === 'Pending'): ?>
        <div class="card card-outline mb-3 emas-status-card border-warning">
            <div class="card-body d-flex align-items-center justify-content-between flex-wrap">
                <div class="d-flex align-items-center">
                    <div class="emas-status-icon bg-warning text-dark">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 font-weight-bold">Usajili wako bado upo Pending</h5>
                        <div class="text-dark-50">Tunaendelea kuhakiki taarifa za shule yako. Utaarifiwa baada ya kuidhinishwa (Approved).</div>
                    </div>
                </div>
                <div class="mt-2 mt-md-0">
                    <span class="badge badge-warning text-dark p-2">Status: Pending</span>
                </div>
            </div>
        </div>
    <?php elseif($school && $school->status === 'Approved'): ?>
        <div class="card mb-3 emas-welcome-card">
            <div class="card-body emas-welcome-body">
                <div class="emas-welcome-top">Hello <span class="ml-1">👋</span> <span class="ml-1">✨</span></div>
                <div class="emas-welcome-title"><?php echo e($school->name); ?>, welcome back</div>
                <div class="emas-welcome-sub">Karibu kwenye mfumo wa <span class="font-weight-bold">Electronic Marking System (EMAS)</span></div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?php echo e($totalStudents ?? 0); ?></h3>
                    <p>Total Students</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <a href="<?php echo e(route('user.students.index')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?php echo e($totalClasses ?? 0); ?></h3>
                    <p>Total Classes</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chalkboard"></i>
                </div>
                <a href="<?php echo e(route('user.classes.index')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?php echo e($totalSubjects ?? 0); ?></h3>
                    <p>Total Subjects</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
                <a href="<?php echo e(route('user.subjects.index')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3><?php echo e($totalExams ?? 0); ?></h3>
                    <p>Total Exams</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <a href="<?php echo e(route('user.exams.index')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">
                        <i class="fas fa-clipboard-list mr-1"></i> Student Registration Summary
                    </h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Class</th>
                                    <th class="text-center">Students</th>
                                    <th class="text-center">Male</th>
                                    <th class="text-center">Female</th>
                                    <th class="text-center">Missing DOB</th>
                                    <th style="width: 160px;">Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = ($classStats ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td class="font-weight-bold"><?php echo e($row['class_level']); ?></td>
                                        <td class="text-center"><?php echo e($row['total']); ?></td>
                                        <td class="text-center"><?php echo e($row['male']); ?></td>
                                        <td class="text-center"><?php echo e($row['female']); ?></td>
                                        <td class="text-center">
                                            <?php if($row['without_dob'] > 0): ?>
                                                <span class="badge badge-warning text-dark"><?php echo e($row['without_dob']); ?></span>
                                            <?php else: ?>
                                                <span class="badge badge-success">0</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="progress flex-grow-1" style="height: 10px;">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo e($row['progress']); ?>%"></div>
                                                </div>
                                                <span class="badge badge-success ml-2"><?php echo e($row['progress']); ?>%</span>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">No student records found yet.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">
                        <i class="fas fa-chart-bar mr-1"></i> Registration by Sex
                    </h3>
                </div>
                <div class="card-body">
                    <canvas id="genderChartCanvas" height="120"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card bg-success shadow-sm mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-white-50">Completed Profiles</div>
                            <div class="h4 font-weight-bold mb-0">
                                <?php echo e(($overview['total_students'] ?? 0) - ($overview['without_dob'] ?? 0)); ?> / <?php echo e($overview['total_students'] ?? 0); ?>

                            </div>
                            <div class="text-white-50">Students with DOB filled</div>
                        </div>
                        <div class="text-right">
                            <div class="h2 font-weight-bold mb-0"><?php echo e($overview['completion_percent'] ?? 0); ?>%</div>
                            <div class="text-white-50">Completion</div>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 10px; background: rgba(255,255,255,.2);">
                        <div class="progress-bar" role="progressbar" style="width: <?php echo e($overview['completion_percent'] ?? 0); ?>%; background: rgba(255,255,255,.9);"></div>
                    </div>
                </div>
            </div>

            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">
                        <i class="fas fa-tasks mr-1"></i> Registration Progress
                    </h3>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="text-muted"><?php echo e($school?->name ?? 'School'); ?></div>
                        <div class="font-weight-bold">
                            <?php echo e(($overview['total_students'] ?? 0) - ($overview['without_dob'] ?? 0)); ?>/<?php echo e($overview['total_students'] ?? 0); ?>

                            <span class="text-muted">(<?php echo e($overview['completion_percent'] ?? 0); ?>%)</span>
                        </div>
                    </div>
                    <div class="progress mt-2" style="height: 12px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo e($overview['completion_percent'] ?? 0); ?>%"></div>
                    </div>

                    <div class="mt-3 small text-muted">
                        Missing DOB: <span class="font-weight-bold"><?php echo e($overview['without_dob'] ?? 0); ?></span>
                    </div>
                    <div class="small text-muted">
                        Missing Middle Name: <span class="font-weight-bold"><?php echo e($overview['without_middle_name'] ?? 0); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Performance Summary</h3>
                </div>
                <div class="card-body">
                    <p>Pass Rate Overview visualization area...</p>
                    <div style="height: 250px; background: #f4f6f9; border-radius: 8px; border: 1px dashed #28a745; display: flex; align-items: center; justify-content: center;">
                        <span class="text-success font-weight-bold">Performance Chart</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Recent Activities</h3>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">New student registered: <strong>John Doe</strong></li>
                        <li class="list-group-item">Exam results published: <strong>Midterm 2024</strong></li>
                        <li class="list-group-item">New class created: <strong>Form 4 Gold</strong></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
        .bg-warning { background-color: #ffc107 !important; }

        .emas-status-card {
            background: #fff3cd;
        }

        .emas-status-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,.08);
        }

        .emas-welcome-card {
            border: 0;
            color: #fff;
            border-radius: 16px;
            overflow: hidden;
            background: linear-gradient(135deg, #0b3a2f 0%, #0f5a45 45%, #137a57 100%);
            box-shadow: 0 12px 28px rgba(0,0,0,.14);
            position: relative;
        }

        .emas-welcome-body {
            padding: 22px 22px;
            position: relative;
            z-index: 2;
        }

        .emas-welcome-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 20% 10%, rgba(255, 193, 7, .14) 0%, rgba(255, 193, 7, 0) 50%),
                radial-gradient(circle at 75% 35%, rgba(255,255,255,.12) 0%, rgba(255,255,255,0) 55%);
            z-index: 1;
        }

        .emas-welcome-top {
            font-weight: 700;
            color: rgba(255, 193, 7, .95);
            letter-spacing: .2px;
            margin-bottom: 6px;
        }

        .emas-welcome-title {
            font-size: 28px;
            line-height: 1.15;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .emas-welcome-sub {
            color: rgba(255,255,255,.85);
        }

        .progress {
            border-radius: 999px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
        (function () {
            const chartData = <?php echo json_encode($genderChart ?? ['labels' => [], 'male' => [], 'female' => []]) ?>;
            const canvas = document.getElementById('genderChartCanvas');
            if (!canvas) return;

            const ctx = canvas.getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartData.labels || [],
                    datasets: [
                        {
                            label: 'Male',
                            data: chartData.male || [],
                            backgroundColor: 'rgba(40, 167, 69, 0.75)',
                            borderColor: 'rgba(40, 167, 69, 1)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Female',
                            data: chartData.female || [],
                            backgroundColor: 'rgba(108, 117, 125, 0.55)',
                            borderColor: 'rgba(108, 117, 125, 1)',
                            borderWidth: 1,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0 }
                        }
                    },
                    plugins: {
                        legend: { position: 'top' },
                        tooltip: { enabled: true }
                    }
                }
            });
        })();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\ZERIXA\WebApps\emas\resources\views/user/dashboard.blade.php ENDPATH**/ ?>