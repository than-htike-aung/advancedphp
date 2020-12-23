 

<?php $__env->startSection('title', 'Category Create'); ?>

<?php $__env->startSection('content'); ?>

<style>
    .pagination > li {
        padding: 5px 15px;
        background: #ddd;
        color: #000;
        margin-right: 1px;
    }
</style>



<div class="container my-5">
    <h1 class="text-primary text-center">Create Category</h1>





<div class="row">











    <div class="col-md-4">
        <?php echo $__env->make("layout.admin_sidebar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <div class="col-md-8">
            <?php echo $__env->make("layout.report_message", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

             <?php if(\App\classes\Session::has("delete_success")): ?>
                     <?php echo e(\App\classes\Session::flash("delete_success")); ?>


            <?php endif; ?>
            <?php if(\App\classes\Session::has("delete_fail")): ?>
                <?php echo e(\App\classes\Session::flash("delete_fail")); ?>


            <?php endif; ?>
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
                            <i class="fa fa-edit text-warning" id="modelCaller" onclick="fun()"></i>
                              <a href="/admin/category/<?php echo e($cat->id); ?>/delete">
                                  <i class="fa fa-trash text-danger"></i>
                              </a>

                        </span>  
                 </li>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
          
          </ul>
          <div class="mt-5"></div>
          <?php echo $pages; ?>

    </div>
</div>

</div>

<!--Modal Start -->

<div class="modal fade" id="CategoryEditModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
<!--Modal End -->
<?php $__env->stopSection(); ?>
   
<?php $__env->startSection('script'); ?>
 <script>
   function fun(){
       alert(123);
   }
 </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>