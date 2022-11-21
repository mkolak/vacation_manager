<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacationRequest\RespondVacationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\VacationRequest;

class ApproverController extends Controller
{
    public function dashboard()
    {
        $users = auth()->user()->team->users->where('role', '=', 'employee');

        $activeVacationRequests = collect();
        foreach ($users as $user) {
            $activeVacationRequests = $activeVacationRequests->merge($user->vacationRequests->where('status', '=', 'pending'));
        }

        return view('users.approver.dashboard', [
            'users' => $users,
            'vacationRequests' => $activeVacationRequests
        ]);
    }

    public function employee(User $employee)
    {
        $team_employees = auth()->user()->team->users->where('id', '=', $employee->id);
        if (empty($team_employees)) {
            return abort(403, 'Unauthorized access');
        }

        return view('users.approver.employee.dashboard', [
            'user' => $employee
        ]);
    }

    public function employeeRequest(User $employee, VacationRequest $vacationRequest)
    {
        if ($vacationRequest->user_id != $employee->id) {
            return abort(404, 'Vacation request doesn\'t belong to employee');
        }

        return view('requests.show', [
            'vacation' => $vacationRequest,
        ]);
    }

    public function vacationResponse(RespondVacationRequest $vacationResponse, VacationRequest $vacationRequest)
    {
        $resp = $vacationResponse->validated();

        // Making sure status response is inserted into proper field.
        if (auth()->user()->approver_role == "team_leader") {
            $vacationRequest->team_leader_status = $resp['vacationResponse'];
            $vacationRequest->team_leader_message = $resp['message'];
        }

        if (auth()->user()->approver_role == "project_leader") {
            $vacationRequest->project_leader_status = $resp['vacationResponse'];
            $vacationRequest->project_leader_message = $resp['message'];
        }

        // Vacation request is declines if one team approvers declines it.
        // Else if both team approvers approved it, vacation request is approved.
        // Otherwise, further updates are needed to determine final status of vacation request.
        if ($resp['vacationResponse'] == "declined") {
            $vacationRequest->status = "declined";
        } else if ($vacationRequest->team_leader_status === "approved" && $vacationRequest->project_leader_status === "approved") {
            $vacationRequest->status = "approved";

            $this->updateUserOnApproval($vacationRequest->user, $vacationRequest);
        }

        $vacationRequest->update();
        return redirect('/approver/dashboard');
    }

    private function updateUserOnApproval(User $user, VacationRequest $vacationRequest)
    {

        $user->remaining_vacation_days = $user->remaining_vacation_days - $vacationRequest->vacation_days;


        // Autocancel all pending requests that ask for more days than user has available now.
        $user->vacationRequests->filter(function ($vacation) use ($user) {
            return $vacation->status === 'pending' && $vacation->vacation_days > $user->remaining_vacation_days;
        })->each(function ($vacation) {
            return $vacation->update([
                'status' => 'cancelled'
            ]);
        });

        $user->save();
    }
}
