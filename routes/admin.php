<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CompanyDetailsController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\RentalController;
use App\Http\Controllers\Admin\CustomerController;

Route::group(['prefix' =>'admin/', 'middleware' => ['auth', 'is_admin']], function(){
  
    Route::get('/dashboard', [HomeController::class, 'adminHome'])->name('admin.dashboard');

    //Customer crud
    Route::get('/customer', [CustomerController::class, 'index'])->name('allcustomer');
    Route::post('/customer', [CustomerController::class, 'store']);
    Route::get('/customer/{id}/edit', [CustomerController::class, 'edit']);
    Route::post('/customer-update', [CustomerController::class, 'update']);
    Route::get('/customer/{id}', [CustomerController::class, 'delete']);

    //Car crud
    Route::get('/car', [CarController::class, 'index'])->name('allcar');
    Route::post('/car', [CarController::class, 'store']);
    Route::get('/car/{id}/edit', [CarController::class, 'edit']);
    Route::post('/car-update', [CarController::class, 'update']);
    Route::get('/car/{id}', [CarController::class, 'delete']);

    Route::get('/rentals', [RentalController::class, 'index'])->name('allrental');
    
});
  