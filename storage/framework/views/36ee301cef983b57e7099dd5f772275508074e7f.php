<?php $__env->startSection('code', '503'); ?>
<?php $__env->startSection('title', __('Service Unavailable')); ?>

<?php $__env->startSection('image'); ?>
<div style="background-image: url('/svg/503.svg');" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('message', __($exception->getMessage() ?: 'Sorry, we are doing some maintenance. Please check back soon.')); ?>

<?php echo $__env->make('errors::illustrated-layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>