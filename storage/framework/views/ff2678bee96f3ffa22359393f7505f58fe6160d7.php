<?php $__env->startSection('body'); ?>

<?php echo e('hello this is admin page'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.adminapp', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>