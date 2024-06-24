<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role == 'employee') {
        return redirect()->route('dashboard.employee');
    } elseif ($user->role == 'hr') {
        return redirect()->route('dashboard.hr');
    } elseif ($user->role == 'manager') {
        return redirect()->route('dashboard.manager');
    }

    abort(403, 'Unauthorized');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/employee', [DashboardController::class, 'employee'])->middleware(['auth', 'verified', 'role:employee'])->name('dashboard.employee');
Route::get('/dashboard/hr', [DashboardController::class, 'hr'])->middleware(['auth', 'verified', 'role:hr'])->name('dashboard.hr');
Route::get('/dashboard/manager', [DashboardController::class, 'manager'])->middleware(['auth', 'verified', 'role:manager'])->name('dashboard.manager');

Route::middleware(['auth', 'verified','role:employee'])->group(function () {
    Route::get('/goals/create', [GoalController::class, 'create'])->name('goals.create');
    Route::post('/goals', [GoalController::class, 'store'])->name('goals.store');
    Route::get('/goals/{goal}/resubmit', [GoalController::class, 'showResubmitForm'])->name('goals.showResubmitForm');
    Route::put('/goals/{goal}/resubmit', [GoalController::class, 'resubmit'])->name('goals.resubmit');
    
});
Route::middleware(['auth', 'verified','role:hr'])->group(function () {
Route::put('/goals/{goal}/finalize', [GoalController::class, 'finalize'])->name('goals.finalize');
});


Route::middleware(['auth', 'verified', 'role:manager'])->group(function () {
    Route::get('/goals/{goal}/review', [GoalController::class, 'review'])->name('goals.review');
    Route::put('goals/{goal}/update-status', [GoalController::class, 'updateStatus'])->name('goals.updateStatus');
    Route::put('goals/{goal}/assess', [GoalController::class, 'assess'])->name('goals.assess');
});


require __DIR__.'/auth.php';
