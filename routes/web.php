<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\FrontendController;

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

// ==============Admin Dashboard====================
Route::middleware('auth', 'adminCheck')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

//home
Route::get('/', [HomeController::class, 'home'])->name('home');
//auth
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
//lang
Route::get('lang/change', [LangController::class, 'lang_change'])->name('lang.change');

// admin route
Route::prefix('admin')->middleware(['auth', 'adminCheck'])->group(function () {

    Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');
    Route::post('/stocks', [StockController::class, 'store'])->name('stocks.store');
    Route::get('/products/{product}/stock', [StockController::class, 'fetchStock'])->name('products.stock');

    //product
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/pro/delete/{id}', [ProductController::class, 'delete'])->name('delete');
});
