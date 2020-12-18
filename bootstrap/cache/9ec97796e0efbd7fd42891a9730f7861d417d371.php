<?php $__env->startSection('title', 'Home page'); ?>

<?php $__env->startSection('content'); ?>

    <h1>Hello World</h1>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>