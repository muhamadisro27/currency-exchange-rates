<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
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
    return redirect()->to('login');
});

Route::middleware('auth')->group(function () {

    Route::prefix('dashboard')->controller(DashboardController::class)->name('dashboard')->group(function() {
        Route::get('/', 'index')->can('view-dashboard');
    });
    Route::prefix('user')->controller(UserController::class)->name('user.')->group(function () {
        Route::get('/', 'index')->can('view-user');
        Route::get('get-data', 'get_data')->name('get-data')->can('view-user');
        Route::get('create', 'form')->name('create')->can('create-user');
        Route::get('edit/{user}', 'form')->name('edit')->can('edit-user');
        Route::post('save/{user?}', 'save')->name('save')->can('edit-user')->can('create-user');
        Route::delete('destroy/{user}', 'destroy')->name('destroy')->can('delete-user');
    });

});

require __DIR__.'/auth.php';
