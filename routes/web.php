<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [VisitorController::class, 'index']);

Route::post('/check-my-time', [VisitorController::class, 'check_my_time'])->name('check_my_time');
Route::post('/update-data', [VisitorController::class, 'update_data'])->name('update_data');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/average-time', [HomeController::class, 'average_time'])->name('average_time');
Route::post('/start_opd', [HomeController::class, 'start_opd'])->name('start_opd');
Route::post('/update-token', [HomeController::class, 'update_token'])->name('update_token');
Route::post('/stop-opd', [HomeController::class, 'stop_opd'])->name('stop_opd');
Route::get('/change-password', [HomeController::class, 'changePassword'])->name('change-password');
Route::post('/change-password', [HomeController::class, 'updatePassword'])->name('update-password');


Route::get('migrate', function () {
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('migrate');
});
