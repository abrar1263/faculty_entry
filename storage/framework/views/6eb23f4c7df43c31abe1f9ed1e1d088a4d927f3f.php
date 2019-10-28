<?php $__env->startSection('body'); ?>

<?php if(session('status')): ?>
    <div class="alert alert-success">
        <?php echo e(session('status')); ?>

    </div>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.adminapp', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>