@extends('layout')

@section('content')
<div class="container">
    <h2>Employee dashboard</h1>
    <hr>
    <div class="row mt-1">
        <table class="table">
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Approver role</th>
                    <th>Remaining vacation days</th>
                </tr>
            </thead>
            <tbody>
                <tr style="font-weight: bold">
                    <td>Current user(Approver)</td>
                    <td>{{ auth()->user()->name}}</td>
                    <td>{{ auth()->user()->email}}</td>
                    <td>{{ auth()->user()->approver_role}}</td>
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
                    <td></td>
                    <td>{{ $user->remaining_vacation_days}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-md-auto" style="margin-top:20px;">
            <div class="table-title" style="display:flex;">
                <h4 style="margin-right: 20px">requests</h4>
            </div>
            <hr>
            <table class="table">
                <thead>
                    <th>Start date</th>
                    <th>End date</th>
                    <th>Vacation days</th>
                    <th>Status</th>
                </thead>
                <tbody class="overflow-auto">
                    @foreach ($user->vacationRequests as $vacation)
                        <tr>
                            <td>{{$vacation->start_date}}</td>
                            <td>{{$vacation->end_date}}</td>
                            <td>{{$vacation->vacation_days}}</td>
                            <td>{{$vacation->status}}</td>
                            <td><form action="{{$user->id}}/{{$vacation->id}}" method="get">
                                <button class="btn btn-dark" type="submit">View</button>
                            </form></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <a href="/approver/dashboard" class="btn btn-block btn-dark"> Back </a>
</div>
@endsection