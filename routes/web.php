<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListTransactionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\NomorMejaController;
use App\Http\Controllers\kirimEmailController;

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

// Route::middleware(['Cashier'])->group(function (){
//   Route::get('/list_order', [TransactionController::class, 'list_order'])->name('list_order');
//   Route::get('/list_proses', [TransactionController::class, 'list_proses'])->name('list_proses');
// });



Route::middleware(['auth'])->group(function () {

    Route::middleware(['checkRole:Super Admin'])->group(function (){

    

      Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::controller(DashboardController::class)->prefix('dashboard')->group(function () {
        Route::get('', 'index')->name('dashboard');
      });

      Route::controller(CategoriesController::class)->prefix('category')->group(function () {
        Route::get('', 'index')->name('category');
        Route::get('add','create')->name('category.add');
        Route::post('add','store')->name('category.store');
        Route::get('edit/{id}', 'edit')->name('category.edit');
        Route::post('edit/{id}','update')->name('category.update');
        Route::get('destroy/{id}','destroy')->name('category.destroy');
      });

      Route::controller(ProductsController::class)->prefix('products')->group(function () {
        Route::get('', 'index')->name('products');
        Route::get('add','create')->name('products.add');
        Route::get('eksport_pdf','eksport_pdf')->name('products.eksport_pdf');
        Route::get('eksport_excel','eksport_excel')->name('products.eksport_excel');
        Route::post('add','store')->name('products.store');
        Route::get('edit/{id}','edit')->name('products.edit');
        Route::post('edit/{id}','update')->name('products.update');
        Route::get('destroy/{id}','destroy')->name('products.destroy');
      });

      Route::controller(NomorMejaController::class)->prefix('nomor_meja')->group(function () {
        Route::get('', 'index')->name('nomor_meja');
        Route::get('add','create')->name('nomor_meja.add');
        Route::post('add','store')->name('nomor_meja.store');
        Route::get('edit/{id}','edit')->name('nomor_meja.edit');
        Route::post('edit/{id}','update')->name('nomor_meja.update');
        Route::get('destroy/{id}','destroy')->name('nomor_meja.destroy');
      });


      // Route::get('/list_payment', [TransactionController::class, 'list_payment'])->name('list_payment');
      Route::get('/list_transaksi', [TransactionController::class, 'list_transaksi'])->name('list_transaksi');
      Route::get('/eksport_pdf', [TransactionController::class, 'eksport_pdf'])->name('eksport_pdf');
      Route::get('/eksport_excel', [TransactionController::class, 'eksport_excel'])->name('eksport_excel');
      Route::get('/list_transaksi/list_detail/{id}', [TransactionController::class, 'detail'])->name('list_detail');
      Route::get('print_list_transaction/{id}', [TransactionController::class, 'print_list_transaction'])->name('print_list_transaction');
      // Route::get('/view_cart/{nomor_meja}', [TransactionController::class, 'view_cart'])->name('view_cart');
      // Route::get('/transaction/{tableId}', [TransactionController::class, 'index'])->name('transaction');
      Route::get('/transaction_order', [TransactionController::class, 'transaction_order'])->name('transaction_order');
      Route::get('/live_report_ordering', [TransactionController::class, 'live_report_ordering'])->name('live_report_ordering');

      Route::controller(TransactionController::class)->prefix('transaction')->group(function () {
        Route::get('/{nomor_meja}', 'index')->name('transaction');
        Route::get('/view_cart/{nomor_meja}', 'view_cart')->name('view_cart');
        // Route::get('view_cart', 'view_cart')->name('view_cart');
        // Route::get('cek_produk', 'CekProduk')->name('cek_produk');
        // Route::post('cek_produk', 'CekProduk')->name('cek_produk');
        // Route::get('add_cart/{id_product}/{nomor_meja}', 'add_cart')->name('add_cart');
        Route::post('add_cart/{id_product}/{nomor_meja}', 'add_cart')->name('add_cart');
        Route::post('update_cart/{nomor_meja}', 'update_cart')->name('update_cart') ;
        // Route::post('update_cart', 'update_cart')->name('update_cart');
        // Route::get('save_transaction/{nomor_meja}', 'save_transaction')->name('save_transaction');
        Route::post('save_transaction/{nomor_meja}', 'save_transaction')->name('save_transaction');
        // Route::get('reset_cart', 'reset_cart')->name('reset_cart');
        Route::get('remove_item/{rowId}', 'remove_item')->name('remove_item');

        // Route::get('/list_order', 'list_order')->name('list_order');
        // Route::get('status_proses/{id}', 'status_proses')->name('status_proses');
        // Route::get('list_proses', 'list_proses')->name('list_proses');
        // Route::get('status_serve/{id}', 'status_serve')->name('status_serve');
        // Route::get('list_payment', 'list_payment')->name('list_payment');
        // Route::get('status_done/{id}', 'status_done')->name('status_done');
        // Route::get('list_transaksi', 'list_transaksi')->name('list_transaksi');

        // Route::get('print_list_transaction/{id}', 'print_list_transaction')->name('print_list_transaction');


        // // -----------------------------------------------------------
        // Route::get('index2', 'index2')->name('index_transaction');
        // Route::get('cart', 'cart');
        // Route::get('add/{id}', 'add')->where('id','[0-9]+');
        // Route::get('hapus/{id}', 'hapus')->where('id','[0-9]+');
    
        // Route::get('kirimWA', 'kirimWA')->name('kirimWA');
      });

    });


    Route::middleware(['checkRole:Admin Kasir,Super Admin'])->group(function (){
      Route::get('/list_payment', [TransactionController::class, 'list_payment'])->name('list_payment');
      Route::get('/status_done/{id}', [TransactionController::class, 'status_done'])->name('status_done');
    });

    Route::middleware(['checkRole:Admin Dapur,Super Admin'])->group(function (){
      Route::get('/list_order', [TransactionController::class, 'list_order'])->name('list_order');
      Route::get('/status_proses/{id}', [TransactionController::class, 'status_proses'])->name('status_proses');
      Route::get('/list_proses', [TransactionController::class, 'list_proses'])->name('list_proses');
      Route::get('/status_serve/{id}', [TransactionController::class, 'status_serve'])->name('status_serve');
    });
  
});
  
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::get('/live_report_ordering', [TransactionController::class, 'live_report_ordering'])->name('live_report_ordering');
    Route::controller(TransactionController::class)->prefix('transaction')->group(function () {
      Route::get('/{nomor_meja}', 'index')->name('transaction');
      Route::get('/view_cart/{nomor_meja}', 'view_cart')->name('view_cart');
      // Route::get('view_cart', 'view_cart')->name('view_cart');
      // Route::get('cek_produk', 'CekProduk')->name('cek_produk');
      // Route::post('cek_produk', 'CekProduk')->name('cek_produk');
      // Route::get('add_cart/{id_product}/{nomor_meja}', 'add_cart')->name('add_cart');
      Route::post('add_cart/{id_product}/{nomor_meja}', 'add_cart')->name('add_cart');
      Route::post('update_cart/{nomor_meja}', 'update_cart')->name('update_cart') ;
      // Route::post('update_cart', 'update_cart')->name('update_cart');
      // Route::get('save_transaction/{nomor_meja}', 'save_transaction')->name('save_transaction');
      Route::post('save_transaction/{nomor_meja}', 'save_transaction')->name('save_transaction');
      // Route::get('reset_cart', 'reset_cart')->name('reset_cart');
      Route::get('remove_item/{rowId}', 'remove_item')->name('remove_item');

      // Route::get('/list_order', 'list_order')->name('list_order');
      // Route::get('status_proses/{id}', 'status_proses')->name('status_proses');
      // Route::get('list_proses', 'list_proses')->name('list_proses');
      // Route::get('status_serve/{id}', 'status_serve')->name('status_serve');
      // Route::get('list_payment', 'list_payment')->name('list_payment');
      // Route::get('status_done/{id}', 'status_done')->name('status_done');
      // Route::get('list_transaksi', 'list_transaksi')->name('list_transaksi');

      // Route::get('print_list_transaction/{id}', 'print_list_transaction')->name('print_list_transaction');


      // // -----------------------------------------------------------
      // Route::get('index2', 'index2')->name('index_transaction');
      // Route::get('cart', 'cart');
      // Route::get('add/{id}', 'add')->where('id','[0-9]+');
      // Route::get('hapus/{id}', 'hapus')->where('id','[0-9]+');
  
      // Route::get('kirimWA', 'kirimWA')->name('kirimWA');
    });

  
    Route::get('register', [AuthController::class, 'register_view'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register');
  
    // Route::get('home', [AuthController::class, 'home'])->name('home');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
