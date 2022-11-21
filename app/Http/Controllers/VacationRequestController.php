<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacationRequest\StoreVacationRequest;
use App\Models\VacationRequest;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class VacationRequestController extends Controller
{
    public function show(VacationRequest $vacationRequest)
    {
        if ($vacationRequest->user_id != auth()->id()) {
            return abort(403, 'unauthorized action');
        }

        return view('requests.show', [
            'vacation' => $vacationRequest,
        ]);
    }

    public function store(StoreVacationRequest $request)
    {
        $formFields = $request->validated();
        $formFields['user_id'] = auth()->id();

        // Check if vacation days exceed remaining vacation days user has.
        $vacation_days = 0;
        $period = CarbonPeriod::create($formFields['start_date'], $formFields['end_date']);
        foreach ($period as $key => $day) {
            if ($day->isWeekday()) $vacation_days++;
        }

        if ($vacation_days > auth()->user()->remaining_vacation_days) {
            return back()->withErrors(['vacation_days' => 'Number of requested days exceeds your remaining number of vacation days']);
        }

        $formFields['vacation_days'] = $vacation_days;
        VacationRequest::create($formFields);

        return redirect('/employee/dashboard');
    }

    public function cancel(VacationRequest $vacationRequest)
    {
        if ($vacationRequest->user_id != auth()->id() || $vacationRequest->status != "pending") {
            return abort(403, 'unauthorized action');
        }

        $vacationRequest->update([
            'status' => 'cancelled'
        ]);

        return redirect('/employee/dashboard');
    }
}
