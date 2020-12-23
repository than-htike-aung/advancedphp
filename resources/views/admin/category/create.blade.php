@extends('layout.master') 

@section('title', 'Category Create')

@section('content')

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

{{-- <img src="{{ asset("images/coder.jpg") }}" alt=""> --}}

<div class="container my-5">
    <h1 class="text-primary text-center">Create Category</h1>





<div class="row">



{{--        @if (isset($errors))--}}

{{--                    @foreach ($errors as $error)--}}
{{--                            {{$error}}--}}
{{--                    @endforeach--}}

{{--        @endif--}}

    <div class="col-md-4">
        @include("layout.admin_sidebar")
    </div>
    <div class="col-md-8">
            @include("layout.report_message")

             @if(\App\classes\Session::has("delete_success"))
                     {{\App\classes\Session::flash("delete_success")}}

            @endif
            @if(\App\classes\Session::has("delete_fail"))
                {{\App\classes\Session::flash("delete_fail")}}

            @endif
        <!-- Form start -->
        <form action="/admin/category/create" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="name" class="form-label">Category Name</label>
              <input type="text" class="form-control rounded-0" id="name" name="name" >
            </div>

              <input type="hidden" name="token" value="{{\App\classes\CSRFToken::__token()}}">
            <div class="row justify-content-end no-gutters mt-3">
                <button type="submit" class="btn btn-primary btn-sm">Create</button>
            </div>
        
        </form>
         <!-- Form end -->
         <ul class="list-group mt-5">
           @foreach($cats as $cat)
                <li class="list-group-item rounded-0">
                        <a href="/admin/category/all">{{ $cat->name }}</a>  
                        <span class="float-right">
                            <i class="fa fa-edit text-warning" id="modelCaller" onclick="fun()" id="edit-cat"></i>
                              <a href="/admin/category/{{$cat->id}}/delete">
                                  <i class="fa fa-trash text-danger"></i>
                              </a>

                        </span>  
                 </li>
           @endforeach
            
          
          </ul>
          <div class="mt-5"></div>
          {!! $pages !!}
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
@endsection
   
@section('script')
 <script>
   function fun(){
       alert(123);
   }
 </script>
@endsection
