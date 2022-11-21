<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\User\StoreUserRequest;

class UserController extends Controller
{
    public function login()
    {
        return view('users.login');
    }

    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (!auth()->attempt($formFields)) {
            return back()->withErrors(['email' => 'invalid credentials'])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect('/' . auth()->user()->role . '/dashboard');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('message', 'logged out succesfully');
    }

    public function store(StoreUserRequest $request)
    {
        $formFields = $request->validated();

        User::create($formFields);
        return redirect('/admin/dashboard');
    }
}
