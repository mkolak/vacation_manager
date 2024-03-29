@extends('layout')

@section('content')
<div class="container">
    <h2>Admin dashboard</h1>
    <hr>
    <div class="row mt-1">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ auth()->user()->name}}</td>
                    <td>{{ auth()->user()->email}}</td>
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
                <form action="/admin/users/register" method="get">
                    <button class="btn btn-dark" type="submit">Create new user</button>
                </form>
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
                            @if ($user->role !== "admin")
                                <td>
                                    <form action="edit-user" method="get"> 
                                        <button class="btn btn-dark" type="submit">Edit</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{$user->role}}/{{$user->id}}" method="get"> 
                                        <button class="btn btn-dark" type="submit">View</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection