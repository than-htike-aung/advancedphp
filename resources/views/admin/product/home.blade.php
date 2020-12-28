@extends("layout.master")

@section("title", "Product Home Page")

@section("content")

    <div class="contianer my-5">
        <div class="row">
            <div class="col-md-4">
                @include("layout.admin_sidebar")
            </div>
            <div class="col-md-8">
                <h1>Product Home</h1>
                @if(\App\Classes\Session::flash("product_insert_success"))
                {{ \App\Classes\Session::flash("product_insert_success") }};
                @endif
            </div>
        </div>
    </div>

@endsection

