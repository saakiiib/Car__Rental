<?php

use App\Http\Controllers\Frontend\PageController;
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Frontend\RentalController;
  

// cache clear
Route::get('/clear', function() {
    Auth::logout();
    session()->flush();
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
 });
//  cache clear
  
  
Auth::routes();
Route::get('/', [FrontendController::class, 'index'])->name('homepage');
route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::get('/dashboard', [FrontendController::class, 'dashboard'])->name('dashboard');

Route::fallback(function () {
    return redirect('/');
});
  

Route::group(['prefix' =>'user/', 'middleware' => ['auth', 'is_user']], function(){
  
    Route::get('/dashboard', [HomeController::class, 'userHome'])->name('user.dashboard');
    Route::get('/rent/{car_id}', [RentalController::class, 'rent'])->name('user.rent');
    route::post('/rent', [RentalController::class, 'store'])->name('user.rent.store');
    Route::get('/rentals', [RentalController::class, 'index'])->name('user.rentals');
    route::delete('/user/rentals/{id}/cancel', [RentalController::class, 'cancel'])->name('user.rent.cancel');
});