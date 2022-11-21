@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4" style="margin-top:20px;">
            <h4>Vacation request</h4>
            <hr>
            <form action="/employee/requests/{{$vacation->id}}/cancel" method="get">
                <div class="form-group">
                    <label class="fw-bold">Employee</label>
                    <p>{{$vacation->user->name}}</p>
                </div>
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
                @can('vacation_cancel')    
                    @if ($vacation->status == "pending")
                        <div class="form-group">
                            <button class="btn btn-block btn-danger" type="submit">Cancel request</button>
                        </div>
                    @endif
                @endcan
                <br>
            </form>
            @can('vacation_respond', $vacation)
            <form action="/approver/request/{{$vacation->id}}/respond" method="post">
                @csrf
                @method('post')
                <div class="form-group">
                    <label for="vacationResponse">Vacation response</label>
                    <select class="form-select" name="vacationResponse" aria-label="Default select example">
                        <option selected value="approved">Approve</option>
                        <option value="declined">Decline</option>
                      </select>
                      <span class="text-danger">@error('vacationResponse')
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
                <div class="form-group">
                    <button class="btn btn-block btn-primary" type="submit">Respond</button>
                </div>
            </form>
            @endcan
                <a href="{{ url()->previous() }}" class="btn btn-block btn-dark mt-2"> Back </a>
        </div>
    </div>
    <style>
        .form-group {
            margin-top: 10px;
        }
    </style>
</div>
@endsection