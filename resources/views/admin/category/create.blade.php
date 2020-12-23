@extends('layout.master') 

@section('title', 'Category Create')

@section('content')

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
                            <i class="fa fa-edit text-warning"></i>
                              <a href="/admin/category/{{$cat->id}}/delete">
                                  <i class="fa fa-trash text-danger"></i>
                              </a>

                        </span>  
                 </li>
           @endforeach
            
          
          </ul>
    </div>
</div>

</div>

@endsection
   
