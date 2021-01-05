<?php $__env->startSection('title', 'Home page'); ?>

<?php $__env->startSection('content'); ?>

<div class="container my-5">

    <h1 class="text-info english">Featured</h1>
    <div class="row">
        <?php $__currentLoopData = $featured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-header"><?php echo e($product->name); ?></div>   
                 <div class="card-block">
                    <img src="<?php echo e($product->image); ?>" class="img-fluid"  alt="">     
                </div> 
                <div class="card-footer">
                    <div class="row justify-content-between">
                        <button class="btn btn-info btn-sm">
                            <i class="fa fa-eye"></i>
                          </button> 
                          <span>$<?php echo e($product->price); ?></span>
                          <button class="btn btn-info btn-sm" onclick="addToCart('<?php echo e($product->id); ?>')">
                              <i class="fa fa-shopping-cart"></i>
                            </button> 
                    </div> 
                </div>
            </div>
        </div>    
            
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       
    </div>    


    <h1 class="text-info english">Most Popular</h1>
    <div class="row">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-header"><?php echo e($product->name); ?></div>   
                 <div class="card-block">
                    <img src="<?php echo e($product->image); ?>" class="img-fluid"  alt="">     
                </div> 
                <div class="card-footer">
                    <div class="row justify-content-between">
                        <button class="btn btn-info btn-sm">
                            <i class="fa fa-eye"></i>
                          </button> 
                          <span>$<?php echo e($product->price); ?></span>
                          <button class="btn btn-info btn-sm" onclick="addToCart('<?php echo e($product->id); ?>')">
                              <i class="fa fa-shopping-cart"></i>
                            </button> 
                    </div> 
                </div>
            </div>
        </div>    
            
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       
    </div>    
        <div class="row justify-content-center">
             <?php echo $pages; ?>

        </div>
</div>    

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>