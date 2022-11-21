@extends('layout')

@section('content')
<div class="container">
    <h2>Approver dashboard</h1>
    <hr>
    <div class="row mt-1">
        <table class="table">
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Remaining vacation days</th>
                </tr>
            </thead>
            <tbody>
                <tr style="font-weight: bold">
                    <td>Current user(Admin)</td>
                    <td>{{ auth()->user()->name}}</td>
                    <td>{{ auth()->user()->email}}</td>
                    <td></td>
                    <td><form action="/logout" method="get">
                        @csrf
                        <button class="btn btn-dark" type="submit">
                            <i class="fa-solid fa-door-closed"></i> Logout
                        </button>
                    </form></td>
                </tr>
                <tr>
                    <td>Employee</td>
                    <td>{{ $user->name}}</td>
                    <td>{{ $user->email}}</td>
                    <td>{{ $user->remaining_vacation_days}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-md-auto" style="margin-top:20px;">
            <div class="table-title" style="display:flex;">
                <h4 style="margin-right: 20px">Users</h4>
            </div>
            <hr>
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                </thead>
                <tbody class="overflow-auto">
                    @foreach ($team_users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role}}</td>
                            <td>
                                <form action="/admin/employee/{{$user->id}}" method="get"> 
                                    <button class="btn btn-dark" type="submit">View</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <a href="/admin/dashboard" class="btn btn-block btn-dark"> Back </a>
</div>
@endsection