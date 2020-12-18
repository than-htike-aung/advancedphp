@extends('layout.master') 

@section('title', 'Category Create')

@section('content')

{{-- <img src="{{ asset("images/coder.jpg") }}" alt=""> --}}

<div class="container my-5">
    <h1 class="text-primary text-center">Create Category</h1>
    <div class="col-md-8 offset-md-2">
        <!-- Form start -->
        <form action="/admin/category/create" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="name" class="form-label">Category Name</label>
              <input type="text" class="form-control rounded-0" id="name" name="name" >
            </div>

            <div class="form-group">
                <label for="file" class="form-label">Category Name</label>
                <input type="file" class="form-control rounded-0" id="file" name="file" >
              </div>
            <div class="row justify-content-end no-gutters mt-3">
                <button type="submit" class="btn btn-primary btn-sm">Create</button>
            </div>
        
        </form>
         <!-- Form end -->
    </div>
</div>

@endsection
   
   