@extends('layout.master')

@section('title', 'Home page')

@section('content')

    <div class="container my-5">

        <h1 class="text-info english">Featured</h1>
        <div class="jumbotron">
            <div class="row">
               <div class="col-md-3">
                   <img src="{{$product->image}}" class="img-fluid" alt="">
               </div>
                <div class="col-md-9">
                   <h3>{{$product->name}}</h3>
                    <p>{{$product->description}}</p>
                    <button class="btn btn-warning rounded-0">$ {{$product->price}}</button>
                    <button class="btn btn-success rounded-0">Add To Cart</button>
                    <p class="mt-3">
                        <span>
                            Rate :
                                <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star-half text-warning"></i>
                        </span>
                    </p>
                    <h4>Special offer will due in</h4>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                            role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                             style="width: 75%">
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection

