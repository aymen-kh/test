<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
   CategoryController,
   MenuController,
   ItemController,
   AreaController,
OrderController,
ReservationController,
RestaurantController,
UserController,
ProfileController,
TableController,
};

Route::resource('items', ItemController::class);

Route::middleware('auth')->group(function () {
   Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
   Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
   Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth'])->group(function () {
   Route::resource('orders', OrderController::class);
   Route::get('/cancel', [OrderController::class, 'cancel'])->name('order.cancel');
   Route::get('/order-success', [OrderController::class, 'success'])->name('order.success');
   Route::post('/process-order', [OrderController::class, 'process'])->name('order.process');
   Route::get('orders/{order}/mark-as-paid', [OrderController::class, 'markAsPaid'])->name('orders.markAsPaid');

   Route::middleware('permission:user_access')->group(function () {
         Route::resource('users', UserController::class);
      Route::get('UsersReport', [UserController::class, 'report'])->name('users.report');
      Route::get('/report/pdf', [UserController::class, 'exportPdf'])->name('report.pdf');
      Route::get('/report/excel', [UserController::class, 'exportExcel'])->name('report.excel');
  });

  Route::middleware('permission:area_edit')->group(function () {

  Route::resource('areas', AreaController::class);
  });

  Route::middleware('permission:restaurant_access')->group(function () {
   Route::get('/reports/orders', [OrderController::class, 'ordersReport'])->name('orders.report');
   Route::resource('restaurants', RestaurantController::class);
   });

   Route::middleware('permission:table_edit')->group(function () {
      Route::resource('tables', TableController::class);
      Route::get('/reservations/{id}/confirm', [ReservationController::class, 'confirm'])->name('reservations.confirm');
      Route::get('/reservations/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel'); 
   });
Route::middleware('permission:category_create')->group(function () {
      Route::resource('categories', CategoryController::class);
   });
Route::middleware('permission:order_edit')->group(function () {
   Route::get('/orders/{id}/invoice', [OrderController::class, 'invoice'])->name('orders.invoice');
   Route::post('/webhook', [ReservationController::class, 'webhook'])->name('order.webhook');
   Route::get('/pos', function () {

      return view('pos');
  })->name('pos');
  Route::get('orders/{order}/mark-as-preparing', [OrderController::class, 'markAsPreparing'])->name('orders.markAsPreparing');
  Route::get('orders/{order}/mark-as-ready', [OrderController::class, 'markAsReady'])->name('orders.markAsReady');
  Route::get('orders/{order}/mark-as-in-delivery', [OrderController::class, 'markAsInDelivery'])->name('orders.markAsInDelivery');
  Route::get('orders/{order}/mark-as-completed', [OrderController::class, 'markAsCompleted'])->name('orders.markAsCompleted');
  Route::get('orders/{order}/cancel', [OrderController::class, 'cancelOrder'])->name('orders.cancelOrder');
 });
  
   Route::resource('menus', MenuController::class);
  
   Route::resource('reservations', ReservationController::class);
});


Route::get('reservation/create2',[ReservationController::class,'reserve'])->name('reservations.create2');
Route::get('/dashboard', function () {

 return redirect('/home');
})
->middleware(['auth', 'verified'])->name('dashboard');
require __DIR__.'/auth.php';


Route::get('/order',[OrderController::class, 'clientorder'])->name('orders.takeorder');


Route::get('/home', function () {
   return view('welcom');
})->name('welcom');

