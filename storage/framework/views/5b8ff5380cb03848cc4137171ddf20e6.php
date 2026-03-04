<?php $__env->startSection('title', 'Academic Years - Results'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-teal-900 mb-2">Examination Results</h2>
        <p class="text-gray-600">Select an academic year to view published results.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php $__empty_1 = true; $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $yearItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(route('public.results.schools', $yearItem->year)); ?>" class="group">
                <div class="bg-white p-8 rounded-xl shadow-sm border-t-4 border-teal-600 text-center feature-card hover:bg-teal-50 transition">
                    <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-teal-200 transition">
                        <i class="fas fa-calendar-alt text-teal-700 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800"><?php echo e($yearItem->year); ?></h3>
                    <p class="text-teal-600 text-sm font-semibold mt-2">View Results <i class="fas fa-arrow-right ml-1"></i></p>
                </div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full text-center py-20 bg-white rounded-xl shadow-sm">
                <i class="fas fa-history fa-4x text-gray-200 mb-4"></i>
                <p class="text-gray-500">No examination results have been published yet.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\ZERIXA\WebApps\emas\resources\views/public/results/index.blade.php ENDPATH**/ ?>