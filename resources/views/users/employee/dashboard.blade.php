@extends('layout')

@section('content')
<div class="container">
    <div class="row mt-1">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Remaining vacation days</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ auth()->user()->name}}</td>
                    <td>{{ auth()->user()->email}}</td>
                    <td>{{ auth()->user()->remaining_vacation_days}}</td>
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
                <h4 style="margin-right: 20px">Requests</h4>
                <form action="/employee/requests/create" method="get">
                    <button class="btn btn-dark" type="submit">Create new request</button>
                </form>
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
                    @foreach ($vacationRequests as $vacation)
                        <tr>
                            <td>{{$vacation->start_date}}</td>
                            <td>{{$vacation->end_date}}</td>
                            <td>{{$vacation->vacation_days}}</td>
                            <td>{{$vacation->status}}</td>
                            <td><form action="/employee/requests/{{$vacation->id}}" method="get">
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