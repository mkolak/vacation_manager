<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApproverController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\VacationRequestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/' . auth()->user()->role . '/dashboard');
})->middleware('auth');

// Guest routes
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/users/authenticate', [UserController::class, 'authenticate'])->middleware('guest');
Route::get('/logout', [UserController::class, 'logout'])->middleware('auth');



// Routes accessible to users with employee privileges
Route::group([
    'prefix' => 'employee',
    'middleware' => ['auth', 'isEmployee']
], function () {
    Route::get('/dashboard', [EmployeeController::class, 'dashboard']);

    Route::get('/requests/create', [EmployeeController::class, 'createRequest']);
    Route::post('/requests', [VacationRequestController::class, 'store']);

    Route::get('/requests/{vacationRequest}', [VacationRequestController::class, 'show']);
    Route::get('/requests/{vacationRequest}/cancel', [VacationRequestController::class, 'cancel']);
});

// Routes accessible to users with approver privileges
Route::group([
    'prefix' => 'approver',
    'middleware' => ['auth', 'isApprover']
], function () {
    Route::get('/dashboard', [ApproverController::class, 'dashboard']);
    Route::get('/employee/{employee}', [ApproverController::class, 'employee']);
    Route::get("/employee/{employee}/{vacationRequest}", [ApproverController::class, 'employeeRequest']);

    Route::post('/request/{vacationRequest}/respond', [ApproverController::class, 'vacationResponse'])->middleware('vacationResponded:vacationRequest');
});

// Routes accessible to administrators
Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth', 'isAdmin']
], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/users/register', [AdminController::class, 'registerUser']);
    Route::post('/users', [UserController::class, 'store']);

    Route::get('/employee/{employee}', [AdminController::class, 'employee']);
    Route::get("/employee/{employee}/{vacationRequest}", [AdminController::class, 'employeeRequest']);


    Route::get('/approver/{approver}', [AdminController::class, 'approver']);

    // Route::get('/teams/register', [AdminController::class, 'registerTeam']);
    // Route::post('/teams', [TeamController::class, 'store']);
});
