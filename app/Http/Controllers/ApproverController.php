<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApproverController extends Controller
{
    public function dashboard()
    {
        return view('users.approver.dashboard');
    }
}
