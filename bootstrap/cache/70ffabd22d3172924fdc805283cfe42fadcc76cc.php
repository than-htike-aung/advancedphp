<?php $__env->startSection('title', 'Payment Success'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container my-5">
        <h1 class="text-success english bm-font-45">Payment Success</h1>
        <a href="/">Go Back Home</a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        localStorage.removeItem('products');
        localStorage.removeItem('items');
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layout.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>