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
                    <label for="name">Name</label>
                    <input type="text" class="form-control" placeholder="Enter name" name="name" value="{{old('name')}}">
                    <span class="text-danger">@error('name')
                        {{$message}}
                    @enderror</span>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" placeholder="Enter email" name="email" value="{{old('email')}}">
                    <span class="text-danger">@error('email')
                        {{$message}}
                    @enderror</span>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" placeholder="Enter password" name="password">
                    <span class="text-danger">@error('password')
                        {{$message}}
                    @enderror</span>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm password</label>
                    <input type="password" class="form-control" placeholder="Confirm password" name="password_confirmation">
                    <span class="text-danger">@error('password_confirmation')
                        {{$message}}
                    @enderror</span>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-select" name="role" aria-label="Default select example">
                        <option selected value="employee">Employee</option>
                        <option value="approver">Approver</option>
                        <option value="admin">Admin</option>
                      </select>
                      <span class="text-danger">@error('role')
                        {{$message}}
                    @enderror</span>
                </div>

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
                    <label for="approver_role">Approver role(only for approver)</label>
                    <select class="form-select" name="approver_role" aria-label="Default select example">
                        <option selected value="team_leader">Team leader</option>
                        <option value="project_leader">Project leader</option>
                      </select>
                      <span class="text-danger">@error('approver_role')
                        {{$message}}
                    @enderror</span>
                </div>

                <div class="form-group">
                    <label for="remaining_vacation_days">Vacation days</label>
                    <input type="number" class="form-control" placeholder="Enter remaining vacation days" name="remaining_vacation_days">
                    <span class="text-danger">@error('remaining_vacation_days')
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