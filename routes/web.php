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
});

// Routes accessible to administrators
Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth', 'isAdmin']
], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
});
