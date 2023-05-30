<?php

use Illuminate\Support\Facades\Auth;
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
    return redirect()->route('login');
});

Route::post('/export', [\App\Http\Controllers\AssetController::class, 'printTable'])->name('export');


Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');
    Route::get('/assets/on', [App\Http\Controllers\AssetController::class, 'getAssetsOn'])
        ->name('home.on');
    Route::get('/assets/over', [App\Http\Controllers\AssetController::class, 'getAssetsOver'])
        ->name('home.over');
    Route::get('/admins/list', [App\Http\Controllers\AdminController::class, 'getAdmins'])
    ->name('admin.list');
    Route::get('/assets/list', [App\Http\Controllers\AssetController::class, 'getAssets'])
    ->name('asset.list');
    Route::get('/maintenances/list', [App\Http\Controllers\MaintenanceController::class, 'getMaintenances'])
    ->name('maintenance.list');
    Route::get('/locations/list', [App\Http\Controllers\LocationController::class, 'getLocations'])
    ->name('location.list');
    Route::resource('/admins', App\Http\Controllers\AdminController::class);
    Route::resource('/maintenances', App\Http\Controllers\MaintenanceController::class);
    Route::resource('/assets', App\Http\Controllers\AssetController::class);
    Route::resource('/locations', App\Http\Controllers\LocationController::class);
    Route::get('/roles/list', [App\Http\Controllers\RoleController::class, 'getRoles'])
    ->name('role.list');
    Route::resource('/roles', App\Http\Controllers\RoleController::class);
});
