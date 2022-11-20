<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/redirect', [HomeController::class,'redirect'])                         ->name('dashboard.redirect')->middleware('auth', 'verified');
Route::get('/view_catagory', [AdminController::class, 'viewCatagory'])              ->name('view.catagory');
Route::post('/add_catagory', [AdminController::class, 'addCatagory'])               ->name('add.catagory');
Route::delete('/delete_catagory/{id}', [AdminController::class, 'deleteCatagory'])  ->name('delete.catagory');

Route::get('/add_product', [AdminController::class, 'addProduct'])                  ->name('add.product');
Route::post('/create_product', [AdminController::class, 'createProduct'])           ->name('create.product');
Route::get('/view_product', [AdminController::class, 'viewProduct'])                ->name('view.product');
Route::get('/update_page/{id}', [AdminController::class, 'updatePage'])             ->name('update.page');
Route::put('/update_product/{id}', [AdminController::class, 'updateProduct'])       ->name('update.product');
Route::delete('/delete_product/{id}', [AdminController::class, 'deleteProduct'])    ->name('delete.product');
Route::get('/view_order', [AdminController::class, 'viewOrder'])                    ->name('view.order');
Route::get('/search', [AdminController::class,'search'])                            ->name('search');
Route::get('/print_pdf/{id}', [AdminController::class, 'printPDF'])                 ->name('print.pdf');


Route::get('/product_details/{id}', [HomeController::class, 'productDetails'])      ->name('product.details');
Route::get('/product_page', [HomeController::class, 'productPage'])                 ->name('product.page');

Route::get('/view_user', [AdminController::class, 'viewUser'])                      ->name('view.user');
Route::get('/role_user', [AdminController::class, 'roleUser'])                      ->name('role.user');
Route::post('/save_role/{id}', [AdminController::class, 'saveRole'])                ->name('save.role');
Route::delete('/delete_user/{id}', [AdminController::class, 'deleteUser'])          ->name('delete.user');
// Route::put('/update_user/{id}', [AdminController::class, 'updateUser'])          ->name('update.user');

Route::middleware('auth')->group(function(){

    Route::post('/add_cart/{id}', [HomeController::class, 'addCart'])    ->name('add.cart');
    Route::get('/view_cart', [HomeController::class, 'viewCart'])    ->name('view.cart');
    Route::put('/update_cart/{id}', [HomeController::class, 'updateCart'])    ->name('update.cart');
    Route::delete('/delete_cart/{id}', [HomeController::class, 'deleteCart'])    ->name('delete.cart');

    Route::get('/pay_cash', [HomeController::class, 'payCash'])->name('pay.cash');
    Route::get('/stripe/{total_price}', [HomeController::class, 'stripe'])->name('stripe');
    Route::post('/stripe/{total_price}', [HomeController::class, 'stripePost'])->name('stripe.post');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


