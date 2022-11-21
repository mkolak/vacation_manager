<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\VacationRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('users.admin.dashboard', [
            'users' => User::all()
        ]);
    }

    public function registerUser()
    {
        return view('users.register', [
            'teams' => Team::all()
        ]);
    }

    public function employee(User $employee)
    {
        return view('users.admin.employee.dashboard', [
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

    public function approver(User $approver)
    {
        $users = $approver->team->users->where('role', '=', 'employee');

        return view('users.admin.approver.dashboard', [
            'user' => $approver,
            'team_users' => $users
        ]);
    }
}
