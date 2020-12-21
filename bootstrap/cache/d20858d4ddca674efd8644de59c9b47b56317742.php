 

<?php $__env->startSection('title', 'Category Create'); ?>

<?php $__env->startSection('content'); ?>



<div class="container my-5">
    <h1 class="text-primary text-center">Create Category</h1>

    

<div class="row">
    <div class="col-md-4">
        <?php echo $__env->make("layout.admin_sidebar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <div class="col-md-8">
        <!-- Form start -->
        <form action="/admin/category/create" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="name" class="form-label">Category Name</label>
              <input type="text" class="form-control rounded-0" id="name" name="name" >
            </div>

              <input type="hidden" name="token" value="<?php echo e(\App\classes\CSRFToken::__token()); ?>">
            <div class="row justify-content-end no-gutters mt-3">
                <button type="submit" class="btn btn-primary btn-sm">Create</button>
            </div>
        
        </form>
         <!-- Form end -->
         <ul class="list-group mt-5">
           <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item rounded-0">
                        <a href="/admin/category/all"><?php echo e($cat->name); ?></a>  
                        <span class="float-right">
                            <i class="fa fa-edit text-warning"></i>
                            <i class="fa fa-trash text-danger"></i>    
                        </span>  
                 </li>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
          
          </ul>
    </div>
</div>

</div>

<?php $__env->stopSection(); ?>
   

<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>