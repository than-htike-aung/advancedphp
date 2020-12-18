@extends('layout.master')

@section('title', 'Admin Home Page')

@section('content')
    <div class="container my-5">
        <div class="col-md-4">
            @include('layout.admin_sidebar')
        </div>
        <div class="col-md-8"></div>
    </div>
@endsection