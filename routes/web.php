<?php

use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\ShopController;
use App\Http\Livewire\Product\ShowProducts;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\User\ShowUsers;
use App\Http\Livewire\Sale\ShowSales;

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

Route::middleware(['auth:sanctum', 'status'])->group(function () {
    Route::get('usuarios', ShowUsers::class)->name('users')->middleware('can:seeAllUsers');
    Route::get('ventas', ShowSales::class)->name('sales')->middleware('can:seeAllSales');
    Route::get('productos', ShowProducts::class)->name('products')->middleware('can:seeAllProducts');
    Route::get('comprar/{product}', [ShopController::class, 'checkout'])->name('checkout');
    Route::get('mis-compras', [ShopController::class, 'shoppingHistory'])->name('shoppingHistory');
    Route::get('enviar-Email/{product}', [ShopController::class, 'confirmPayment'])->name('confirmPayment');
    route::get('administracion', [DashboardAdminController::class, 'index'])->name('dashboardAdmin')->middleware('can:dashboardAdmin');
});

Route::middleware('status')
    ->group(function () {
        Route::get('producto/{product}', [ShopController::class, 'product'])->name('product');
        Route::get('/', [ShopController::class, 'index'])->name('shop');

    });
    
Route::get('bloqueado', function() {
    return view('inactive-user');
});

