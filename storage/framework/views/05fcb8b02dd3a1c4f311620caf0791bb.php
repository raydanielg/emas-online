<?php $__env->startSection('title', 'Teachers Performance'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-success font-weight-bold mb-0">Teachers Performance</h1>
        <div class="small text-muted">Academic Analysis per Teacher</div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-white">
                    <form method="GET" action="<?php echo e(route('user.teachers.performance')); ?>" class="form-inline">
                        <div class="form-group mr-3">
                            <label class="mr-2 small font-weight-bold">Year:</label>
                            <select name="year" class="form-control form-control-sm" onchange="this.form.submit()">
                                <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($year->name); ?>" <?php echo e($selectedYear == $year->name ? 'selected' : ''); ?>><?php echo e($year->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group mr-3">
                            <label class="mr-2 small font-weight-bold">Term:</label>
                            <select name="term" class="form-control form-control-sm" onchange="this.form.submit()">
                                <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($term->name); ?>" <?php echo e($selectedTerm == $term->name ? 'selected' : ''); ?>><?php echo e($term->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <button type="button" class="btn btn-default btn-sm ml-auto" onclick="window.print()">
                            <i class="fas fa-print mr-1"></i> Print Report
                        </button>
                    </form>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Teacher Name</th>
                                <th>Initials</th>
                                <th class="text-center">Results Recorded</th>
                                <th class="text-center">Average Score</th>
                                <th>Performance Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $teacherPerformance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td class="font-weight-bold"><?php echo e($perf->name); ?></td>
                                    <td><span class="badge badge-secondary"><?php echo e($perf->initials); ?></span></td>
                                    <td class="text-center"><?php echo e($perf->total_results); ?></td>
                                    <td class="text-center">
                                        <span class="font-weight-bold text-lg <?php echo e($perf->average_score >= 50 ? 'text-success' : 'text-danger'); ?>">
                                            <?php echo e(number_format($perf->average_score, 1)); ?>%
                                        </span>
                                    </td>
                                    <td>
                                        <?php if($perf->total_results == 0): ?>
                                            <span class="text-muted italic">No data</span>
                                        <?php elseif($perf->average_score >= 75): ?>
                                            <span class="badge badge-success px-3">Excellent</span>
                                        <?php elseif($perf->average_score >= 50): ?>
                                            <span class="badge badge-primary px-3">Good</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger px-3">Needs Improvement</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="fas fa-chart-line fa-3x mb-3"></i>
                                        <p>No performance data found for the selected period.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
        .italic { font-style: italic; }
        @media print {
            .card-header form { display: none; }
            .main-footer, .content-header { display: none; }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\ZERIXA\WebApps\emas\resources\views/user/teachers/performance.blade.php ENDPATH**/ ?>