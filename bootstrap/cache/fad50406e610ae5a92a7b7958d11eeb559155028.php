<?php $__env->startSection("title", "Product Home Page"); ?>

<?php $__env->startSection("content"); ?>

    <div class="contianer my-5">
        <div class="row">
            <div class="col-md-4">
                <?php echo $__env->make("layout.admin_sidebar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col-md-8">
                <h1>Product Home</h1>
                <?php echo e(\App\Classes\Session::flash("product_insert_success")); ?>;
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make("layout.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>