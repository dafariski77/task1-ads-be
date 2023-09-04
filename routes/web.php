<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReporterController;
use App\Http\Controllers\ReportTrackerController;
use Illuminate\Support\Facades\Route;

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
    return view('home');
})->name('home');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('reports', [ReportController::class, 'create'])->name('reports.create');
    Route::post('reports', [ReportController::class, 'store'])->name('reports.store');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('reports/logs', [ReportController::class, 'reportLog'])->name('admin.report.log');
    Route::get('reports/trackers', [ReportTrackerController::class, 'index'])->name('admin.report.tracker');

    Route::patch('reports', [AdminController::class, 'updateStatus'])->name('report.update');
});
