@extends('layout.master')

@section('title', 'Home page')

@section('content')

<div class="container my-5">

    <h1 class="text-info english">Featured</h1>
    <div class="row">
        @foreach($featured as $product)

        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-header">{{ $product->name }}</div>   
                 <div class="card-block">
                    <img src="{{ $product->image }}" class="img-fluid"  alt="">     
                </div> 
                <div class="card-footer">
                    <div class="row justify-content-between">
                        <button class="btn btn-info btn-sm">
                            <i class="fa fa-eye"></i>
                          </button> 
                          <span>${{ $product->price }}</span>
                          <button class="btn btn-info btn-sm" onclick="addToCart('{{$product->id}}')">
                              <i class="fa fa-shopping-cart"></i>
                            </button> 
                    </div> 
                </div>
            </div>
        </div>    
            
        @endforeach
       
    </div>    


    <h1 class="text-info english">Most Popular</h1>
    <div class="row">
        @foreach($products as $product)

        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-header">{{ $product->name }}</div>   
                 <div class="card-block">
                    <img src="{{ $product->image }}" class="img-fluid"  alt="">     
                </div> 
                <div class="card-footer">
                    <div class="row justify-content-between">
                        <button class="btn btn-info btn-sm">
                            <i class="fa fa-eye"></i>
                          </button> 
                          <span>${{ $product->price }}</span>
                          <button class="btn btn-info btn-sm" onclick="addToCart('{{$product->id}}')">
                              <i class="fa fa-shopping-cart"></i>
                            </button> 
                    </div> 
                </div>
            </div>
        </div>    
            
        @endforeach
       
    </div>    
        <div class="row justify-content-center">
             {!! $pages !!}
        </div>
</div>    

@endsection

