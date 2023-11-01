<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Vrm\Login as Vrm_Login;
use App\Http\Controllers\Vrm\Dashboard as Vrm_Dashboard;

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

Route::controller(Vrm_Login::class)->group(function () {
    Route::get('/', 'index')->name('vrm-login');
});
// Vrm_Login
Route::controller(Vrm_Login::class)->group(function () {
    Route::get('/vrm-login', 'index')->name('vrm-login');

    // Validation
    Route::post('/vrm-login/{action}', 'valid')->where('action', 'access');

    //Logout
    Route::get('/vrm-logout', 'logout')->name('vrm-logout');
});

Route::get('/vrm-dashboard', [Vrm_Dashboard::class, 'index'])->name('vrm-dashboard');

// Status Hierarchies
Route::controller(App\Http\Controllers\Setup\Status::class)->group(function () {
    Route::get('/setup-status', 'index')->name('setup-status');
    // Save
    Route::post('/setup-status/save', 'store');
    // Save
    Route::post('/setup-status/update', 'update');
    // Edit
    Route::get('/setup-status/edit/{page?}', 'edit');
    // Edit
    Route::get('/setup-status/delete', 'delete');
    // Validation
    Route::get('/setup-status/{action}', 'valid');
});

// Country Hierarchies
Route::controller(App\Http\Controllers\Setup\Country::class)->group(function () {
    Route::get('/setup-country', 'index')->name('setup-country');
    // Save
    Route::post('/setup-country/save', 'store');
    // Save
    Route::post('/setup-country/update', 'update');
    // Edit
    Route::get('/setup-country/edit/{page?}', 'edit');
    // Edit
    Route::get('/setup-country/delete', 'delete');
    // Validation
    Route::get('/setup-country/{action}', 'valid');
});
