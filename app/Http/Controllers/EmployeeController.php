<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function dashboard()
    {
        return view('users.employee.dashboard', [
            'vacationRequests' => auth()->user()->vacationRequests
        ]);
    }

    public function createRequest()
    {
        return view('requests.create');
    }
}
