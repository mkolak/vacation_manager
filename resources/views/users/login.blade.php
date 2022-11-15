@extends('layout')

@section('content')
    
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4" style="margin-top:20px;">
            <h4>Login</h4>
            <hr>
            <form action="/users/authenticate" method="post">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" placeholder="Enter username" name="email" value="{{old('email')}}">
                    <span class="text-danger">@error('email')
                        {{$message}}
                    @enderror</span>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" placeholder="Enter Password" name="password" value="">
                    <span class="text-danger">@error('password')
                        {{$message}}
                    @enderror</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-block btn-primary" type="submit">Login</button>
                </div>
                <br>
            </form>
        </div>
    </div>
    <style>
        .form-group {
            margin-top: 10px;
        }
    </style>
</div>

@endsection