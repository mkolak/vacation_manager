@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4" style="margin-top:20px;">
            <h4>New vacation request</h4>
            <hr>
            <form action="/employee/requests/{{$vacation->id}}/cancel" method="get">
                <div class="form-group">
                    <label class="fw-bold">Vacation start date</label>
                    <p>{{$vacation->start_date}}</p>
                </div>
                <div class="form-group">
                    <label class="fw-bold">Vacation end date</label>
                    <p>{{$vacation->end_date}}</p>
                </div>
                <div class="form-group">
                    <label class="fw-bold">Message</label>
                    <p>{{$vacation->message}}</p>
                </div>
                <div class="form-group">
                    <label class="fw-bold">Status</label>
                    <p>{{$vacation->status}}</p>
                </div>
                @if ($vacation->status == "pending")
                    <div class="form-group">
                        <button class="btn btn-block btn-danger" type="submit">Cancel request</button>
                    </div>
                @endif
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