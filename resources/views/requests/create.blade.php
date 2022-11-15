@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4" style="margin-top:20px;">
            <h4>New vacation request</h4>
            <hr>
            <form action="/employee/requests" method="post">
                @csrf
                <div class="form-group">
                    <label for="start_date">Vacation start date</label>
                    <input type="date" class="form-control" placeholder="Enter start date" name="start_date" value="{{old('start_date')}}">
                    <span class="text-danger">@error('start_date')
                        {{$message}}
                    @enderror</span>
                </div>
                <div class="form-group">
                    <label for="end_date">Vacation end date</label>
                    <input type="date" class="form-control" placeholder="Enter end date" name="end_date" value="{{old('end_date')}}">
                    <span class="text-danger">@error('end_date')
                        {{$message}}
                    @enderror</span>
                </div>
                <div class="form-group">
                    <label for="message">Message(Optional)</label>
                    <textarea name="message" id="" cols="30" rows="10">{{old('message')}}</textarea>
                    <span class="text-danger">@error('message')
                        {{$message}}
                    @enderror</span>
                </div>
                <span class="text-danger">@error('vacation_days')
                    {{$message}}
                @enderror</span>
                <div class="form-group">
                    <button class="btn btn-block btn-primary" type="submit">Create</button>
                </div>
                <br>
            </form>
            <a href="/employee/dashboard" class="btn btn-block btn-dark"> Back </a>
        </div>
    </div>
    <style>
        .form-group {
            margin-top: 10px;
        }
    </style>
</div>
@endsection