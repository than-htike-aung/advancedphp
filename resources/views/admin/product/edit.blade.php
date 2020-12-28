@extends("layout.master")

@section("title", "Product Home Page")

@section("content")

    <div class="contianer my-5">
        <div class="row">
            <div class="col-md-4">
                @include("layout.admin_sidebar")
            </div>
            <div class="col-md-8">
                <h1>Product Edit</h1>
            </div>
        </div>
    </div>

@endsection

