<?php $__env->startSection('title', 'Import Subjects'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="text-success font-weight-bold mb-0">Import Subjects</h1>
            <small class="text-muted">Select subjects from the system to add to your school</small>
        </div>
        <div>
            <a href="<?php echo e(route('user.subjects.index')); ?>" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left mr-1"></i> Back
            </a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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

                <form action="<?php echo e(route('user.subjects.import.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <?php if($subjects->isEmpty()): ?>
                            <div class="text-center py-5">
                                <i class="fas fa-check-circle fa-3x mb-3 text-success"></i>
                                <p class="text-muted mb-0">All available subjects have already been imported to your school.</p>
                            </div>
                        <?php else: ?>
                            <?php
                                $perColumn = (int) ceil($subjects->count() / 2);
                                $columns = $subjects->chunk($perColumn);
                            ?>

                            <div class="row">
                                <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6">
                                        <div class="list-group list-group-flush">
                                            <?php $__currentLoopData = $col; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $isImported = in_array($subject->id, $importedSubjectIds);
                                                ?>
                                                <label class="list-group-item d-flex align-items-center subject-item <?php echo e($isImported ? 'faint-item' : ''); ?>">
                                                    <input type="checkbox" name="subject_ids[]" value="<?php echo e($subject->id); ?>" 
                                                           class="mr-3 subject-checkbox" <?php echo e($isImported ? 'disabled checked' : ''); ?>>
                                                    <div class="flex-grow-1">
                                                        <div class="font-weight-bold <?php echo e($isImported ? 'text-muted' : 'text-dark'); ?>">
                                                            <?php echo e($subject->code); ?> - <?php echo e($subject->name); ?>

                                                            <?php if($isImported): ?>
                                                                <span class="badge badge-secondary ml-2">Imported</span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </label>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if(!$subjects->isEmpty()): ?>
                        <div class="card-footer bg-white">
                            <button type="submit" class="btn btn-success font-weight-bold shadow-sm" id="btnImport" disabled>
                                <i class="fas fa-download mr-1"></i> Import Selected Subjects
                            </button>
                        </div>
                    <?php endif; ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
        .subject-item { border-left: 0; border-right: 0; }
        .subject-item:hover:not(.faint-item) { background: #f8fafc; }
        .subject-item input[type="checkbox"] { transform: scale(1.05); }
        .faint-item { opacity: 0.6; background-color: #fcfcfc; cursor: not-allowed; }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\ZERIXA\WebApps\emas\resources\views/user/subjects/import.blade.php ENDPATH**/ ?>