<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckOutController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AreaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReservationController;

Route::resource('areas', AreaController::class);
//Route::resource('reservations', ReservationController::class);


use App\Http\Controllers\TableController;

Route::resource('tables', TableController::class);
Route::post('/webhook', [ReservationController::class, 'webhook'])->name('order.webhook');
Route::post('reservation/store', [ReservationController::class, 'store'])->name('reservations.store');

Route::get('reservation/create2',[ReservationController::class,'reserve'])->name('reservations.create2');
Route::get('/order-success', [OrderController::class, 'success'])->name('order.success');
Route::get('/my-orders', [OrderController::class, 'index'])->name('orders.index')->middleware('auth');



//Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout1');
Route::post('/process-order', [OrderController::class, 'process'])->middleware('auth')->name('order.process');
//Route::get('/checkout-success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/cancel', [OrderController::class, 'cancel'])->name('order.cancel');
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
  //return back()->withInput();
  // return view('dashboard');
   return redirect('/home');
})->middleware(['auth', 'verified'])->name('dashboard');
//Route::get('/admin', function () {
   // return view('welcom');
//})->middleware(['auth', 'verified','role:admin'])->name('welcom');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ItemController;

Route::resource('categories', CategoryController::class);

Route::resource('items', ItemController::class);

Route::resource('menus', MenuController::class);
Route::resource('orders', OrderController::class);




Route::get('/home', function () {
   return view('welcom');
})->name('welcom');

