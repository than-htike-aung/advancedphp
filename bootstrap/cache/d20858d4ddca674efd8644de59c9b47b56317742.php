 

<?php $__env->startSection('title', 'Category Create'); ?>

<?php $__env->startSection('content'); ?>

<style>
    .pagination > li {
        padding: 5px 15px;
        background: #ddd;
        color: #000;
        margin-right: 1px;
    }
    #edit-cat{
        cursor: pointer;
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

         <!-- Category List Start -->
         <ul class="list-group mt-5">
           <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item rounded-0">
                        <a href="/admin/category/all"><?php echo e($cat->name); ?></a>  
                        <span class="float-right">
                            <i class="fa fa-plus text-primary" style="cursor: pointer"
                       onclick="showSubCatModal('<?php echo e($cat->name); ?>', <?php echo e($cat->id); ?>)"></i>
                            <i class="fa fa-edit text-warning" id="modelCaller" onclick="fun('<?php echo e($cat->name); ?>','<?php echo e($cat->id); ?>')" id="edit-cat"></i>
                              <a href="/admin/category/<?php echo e($cat->id); ?>/delete">
                                  <i class="fa fa-trash text-danger"></i>
                              </a>

                        </span>  
                 </li>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
          
          </ul>
          <div class="mt-2 offset-md-4">
            <?php echo $pages; ?>

        </div>
           <!-- Category List End -->

                <!-- Sub Category List Start -->
                <ul class="list-group mt-5">
                    <?php $__currentLoopData = $sub_cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item rounded-0">
                            <a href="/admin/category/all"><?php echo e($cat->name); ?></a>
                            <span class="float-right">

                            <i class="fa fa-edit text-warning" id="modelCaller" onclick="subCatEdit('<?php echo e($cat->name); ?>','<?php echo e($cat->id); ?>')" id="edit-cat"></i>
                              <a href="/admin/subcategory/<?php echo e($cat->id); ?>/delete">
                                  <i class="fa fa-trash text-danger"></i>
                              </a>

                        </span>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                </ul>
                <div class="mt-2 offset-md-4">
                    <?php echo $sub_pages; ?>

                </div>
                <!--Sub Category List End -->
    </div>
</div>

</div>

<!--Modal Start -->

<div class="modal fade" id="CatUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Form start -->
        <form>
          <div class="form-group">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control rounded-0" id="edit-name">
          </div>

            <input type="hidden" id="edit-token" value="<?php echo e(\App\classes\CSRFToken::__token()); ?>">
            <input type="hidden" id="edit-id">
            <div class="row justify-content-end no-gutters mt-3">
              <button type="submit" class="btn btn-primary btn-sm" onclick="startEdit(event)">Update</button>
          </div>
      
      </form>
       <!-- Form end -->
        </div>
        
      </div>
    </div>
  </div>
<!--Modal End -->

<!--Modal Start -->

<div class="modal fade" id="SubCategoryEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form start -->
                <form>
                    <div class="form-group">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" class="form-control rounded-0" id="sub-cat-edit-name">
                    </div>

                    <input type="hidden" id="sub-cat-edit-token" value="<?php echo e(\App\classes\CSRFToken::__token()); ?>">
                    <input type="hidden" id="sub-cat-edit-id">
                    <div class="row justify-content-end no-gutters mt-3">
                        <button type="submit" class="btn btn-primary btn-sm" onclick="subCatUpdateStart(event)">Update</button>
                    </div>

                </form>
                <!-- Form end -->
            </div>

        </div>
    </div>
</div>
<!--Modal End -->


<!--Sub Category Create Modal Start -->

<div class="modal fade" id="SubCategoryCreateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form start -->
                <form>
                    <div class="form-group">
                        <label for="name" class="form-label">Parent Category</label>
                        <input type="text" class="form-control rounded-0" id="parent-cat-name">
                    </div>

                    <div class="form-group">
                        <label for="name" class="form-label">Sub Category Name</label>
                        <input type="text" class="form-control rounded-0" id="sub-cat-name">
                    </div>

                    <input type="hidden" id="subcat-token" value="<?php echo e(\App\classes\CSRFToken::__token()); ?>">
                    <input type="hidden" id="parent-cat-id">
                    <div class="row justify-content-end no-gutters mt-3">
                        <button type="submit" class="btn btn-primary btn-sm" onclick="createSubCategory(event)">Create</button>
                    </div>

                </form>
                <!-- Form end -->
            </div>

        </div>
    </div>
</div>
<!--Sub Category Create Modal End -->
<?php $__env->stopSection(); ?>
   
<?php $__env->startSection('script'); ?>
 <script>
   function fun(name,id){
     $("#edit-name").val(name);
     $("#edit-id").val(id);
      $("#CatUpdateModal").modal("show");
   }

   function startEdit(e){
     e.preventDefault();
     $name = $("#edit-name").val();
     token = $("#edit-token").val();
    id = $("#edit-id").val();
       $("#CatUpdateModal").modal("hide");

   //  console.log('Name is ' + name + '<br> Token is ' + token + 'id is ' + id);
     
     $.ajax({
      type: 'POST',
      url: '/admin/category/'+id+'/update',
      data:{
        name:$name,
        token:token,
        id:id
      },
      success: function (result){
        //  console.log("Success is " + result);
         // alert(result);
          window.location.href="/admin/category/create";
      },
      error: function (response){
     console.log('response');
          let str = "";
       let resp = (JSON.parse(response.responseText));

            alret(resp.name);
        //alert(JSON.parse(response.responseText).name);
          //alert(123)
      }
     });

   }
   

   function showSubCatModal(name,id) {
        //alert("name is " + name + "id is " +id);
       $('#parent-cat-name').val(name);
       $('#parent-cat-id').val(id);
       $('#SubCategoryCreateModal').modal('show');
   }
   
   function createSubCategory($e) {
    $e.preventDefault();

    var name = $('#sub-cat-name').val();
    var token = $('#subcat-token').val();
    var parent_cat_id = $('#parent-cat-id').val();

       $('#SubCategoryCreateModal').modal('hide');

  //  alert("Name is " + name + " token is " + token +  " parent cat id is " + parent_cat_id);

       $.ajax({
           type: 'POST',
           url: '/admin/subcategory/create',
           data:{
               name:name,
               token:token,
              parent_cat_id:parent_cat_id
           },
           success: function (result){
                console.log("Success is " + result);
               // alert(result);
               window.location.href="/admin/category/create";
           },
           error: function (response){
               console.log('response');
               let str = "";
               let resp = (JSON.parse(response.responseText));

               alret(resp.name);
               //alert(JSON.parse(response.responseText).name);
               //alert(123)
           }
       });

   }

   function  subCatEdit(name, id) {
       $("#sub-cat-edit-name").val(name);
       $("#sub-cat-edit-id").val(id);

       $("#SubCategoryEditModal").modal('show');
   // alert("Sub Cat name is " + name + " Sub cat id is " + id);
   }

   function  subCatUpdateStart($e) {
        $e.preventDefault();
        let name = $("#sub-cat-edit-name").val();
        let id = $("#sub-cat-edit-id").val();
        let token = $("#sub-cat-edit-token").val();
       $("#SubCategoryEditModal").modal('hide');
       // alert("name " + name + " id " + id + " token " + token);

       $.ajax({
           type: 'POST',
           url: '/admin/subcategory/update',
           data:{
               name:name,
               token:token,
               id:id
           },
           success: function (result){
              // console.log("Success is " + result);
               // alert(result);
               window.location.href="/admin/category/create";
           },
           error: function (response){
               console.log('response');
               let str = "";
               let resp = (JSON.parse(response.responseText));

               alret(resp.name);
               //alert(JSON.parse(response.responseText).name);
               //alert(123)
           }
       });
   }

 </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>