<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
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

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::post('/freetrail', [FrontendController::class, 'freetrail'])->name('freetrail.submit');
Route::get('/order/{service_item}', [FrontendController::class, 'order'])->name('order');
Route::post('/order/{service_item}', [FrontendController::class, 'order_submit'])->name('order.submit');

Route::get('/plan/{plans}', [FrontendController::class,'plan_get'])->name('plan_get');
Route::post('/plan/order/{plans}', [FrontendController::class,'plan_get_submit'])->name('plan_get_submit');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // order view 
    Route::get('/singel/order', [FrontendController::class, 'single_order'])->name('single_order');
    Route::get('/all/order', [FrontendController::class, 'plan_order'])->name('plan_order.all');
    Route::get('/trail/order', [FrontendController::class, 'trail_order'])->name('trail_order');
    // order view 
    // plan operation
    Route::resource('plan', PlanController::class);
    // plan operation
    // service operation
    Route::resource('service', ServiceController::class);
    // service operation

});

require __DIR__.'/auth.php';
