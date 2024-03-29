@extends('layout')

@section('content')
<div class="container">
    <h2>Approver dashboard</h1>
    <hr>
    <div class="row mt-1">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Approver role</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ auth()->user()->name}}</td>
                    <td>{{ auth()->user()->email}}</td>
                    <td>{{ auth()->user()->approver_role}}</td>
                    <td><form action="/logout" method="get">
                        @csrf
                        <button class="btn btn-dark" type="submit">
                            <i class="fa-solid fa-door-closed"></i> Logout
                        </button>
                    </form></td>
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
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role}}</td>
                            <td>
                                <form action="employee/{{$user->id}}" method="get"> 
                                    <button class="btn btn-dark" type="submit">View</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-auto" style="margin-top:20px;">
            <div class="table-title" style="display:flex;">
                <h4 style="margin-right: 20px">Active Requests</h4>
            </div>
            <hr>
            <table class="table">
                <thead>
                    <th>User</th>
                    <th>Start date</th>
                    <th>End date</th>
                    <th>Vacation days</th>
                    <th>Status</th>
                </thead>
                <tbody class="overflow-auto">
                    @foreach ($vacationRequests as $vacation)
                        <tr>
                            <th>{{$vacation->user->name}}</th>
                            <td>{{$vacation->start_date}}</td>
                            <td>{{$vacation->end_date}}</td>
                            <td>{{$vacation->vacation_days}}</td>
                            <td>{{$vacation->status}}</td>
                            <td><form action="employee/{{$vacation->user->id}}/{{$vacation->id}}" method="get">
                                <button class="btn btn-dark" type="submit">View</button>
                            </form></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection