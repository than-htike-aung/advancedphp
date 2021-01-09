@extends('layout.master')

@section('title', 'User Login')

@section('content')

    <div class="container my-5">
        <div class="col-md-8 offset-md-2">
            <h1 class="mb-5 text-center text-info english">User Login</h1>

            @if(\App\classes\Session::has("success_message"))
                {{\App\classes\Session::flash("success_message")}}
            @endif

            @if(\App\classes\Session::has("error_message"))
                {{\App\classes\Session::flash("error_message")}}
            @endif

            <form action="/user/login"method="post">
                  <input type="hidden" name="token" value="{{\App\Classes\CSRFToken::__token()}}">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="row justify-content-between no-gutters">
                    <a href="/user/register">Not member yet! Please Register Here!</a>
                    <span>
                        <button class="btn btn-outline-warning btn-sm">Cancel</button>
                        <button class="btn btn-primary btn-sm">Login</button>
                    </span>
                </div>
            </form>
        </div>
    </div>

@endsection
