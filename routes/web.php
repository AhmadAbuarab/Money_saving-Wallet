<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\Admin;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('categories' , [CategoryController::class, 'index'])->name('categories');
Route::post('categories/add', [CategoryController::class, 'store'])->name('categories/add');

Route::get('transactions' , [TransactionController::class, 'index'])->name('transactions');
Route::post('transactions/add', [TransactionController::class, 'store'])->name('transactions/add');

Route::get('transactions/summary' , [TransactionController::class, 'summary'])->name('transactions/summary');

Route::post('getGraph' , [HomeController::class, 'getGraph'])->name('getGraph');

Route::group(['middleware' => 'admin'], function () {
    Route::get('admin', [AdminController::class , 'index']);
    Route::get('/admin_home', [AdminController::class, 'index'])->name('admin_home');
});
