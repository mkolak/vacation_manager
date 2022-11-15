@extends('layout')

@section('content')
<p>
    Admin dashboard
</p>
<form action="/logout" method="get">
    @csrf
    <button class="btn btn-dark" type="submit">
        <i class="fa-solid fa-door-closed"></i> Logout
    </button>
</form>
@endsection