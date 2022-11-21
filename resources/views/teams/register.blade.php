@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4" style="margin-top:20px;">
            <h4>New User</h4>
            <hr>
            <form action="/admin/users" method="post">
                @csrf
                <div class="form-group">
                    <label for="team_id">Team</label>
                    <select class="form-select" name="team_id" aria-label="Default select example">
                        @foreach($teams as $team)
                            <option value="{{$team->id}}">{{$team->id}}</option>
                        @endforeach
                      </select>
                      <span class="text-danger">@error('team_id')
                        {{$message}}
                    @enderror</span>
                </div>

                <div class="form-group">
                    <button class="btn btn-block btn-primary" type="submit">Create</button>
                </div>
                <br>
            </form>
            <a href="/admin/dashboard" class="btn btn-block btn-dark"> Back </a>
        </div>
    </div>
    <style>
        .form-group {
            margin-top: 10px;
        }
    </style>
</div>
@endsection