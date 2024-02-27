<?php

use App\Http\Controllers\ActiveController;
use App\Http\Controllers\Auth\Authcontroller;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\System\AddCartController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect('/registerform');
});

Route::get('/loginform', [Authcontroller::class, 'loginform'])->name('login');
Route::get('/registerform', [Authcontroller::class, 'registerform']);

Route::post('/register', [Authcontroller::class, 'register']);
Route::post('/login', [Authcontroller::class, 'login']);

Route::group(['middleware' => 'auth'], function () {


    Route::get('/home', [ProfileController::class, 'index']);
    Route::get('/create', [ProfileController::class, 'create']);
    Route::get('/all', [ProfileController::class, 'all']);
    Route::post('/add', [ProfileController::class, 'store'])->name('store');
    Route::delete('/delete/{id}', [ProfileController::class, 'destroy'])->name('delete.product');
    Route::get('/edit/{id}', [ProfileController::class, 'edit'])->name('edit.product');
    Route::post('/update/{id}', [ProfileController::class, 'update'])->name('update.product');


    Route::get('/Cart', [AddCartController::class, 'index']);
    Route::post('/add/{id}', [AddCartController::class, 'add'])->name('add.cart');
    Route::post('/delete/{id}', [AddCartController::class, 'delete'])->name('delete.cart');
    Route::post('/increment/{id}', [AddCartController::class, 'increment'])->name('increment.cart');
    Route::post('/decrement/{id}', [AddCartController::class, 'decrement'])->name('decrement.cart');

    Route::post('/private/{id}', [ActiveController::class, 'private'])->name('private');
    Route::post('/unprivate/{id}', [ActiveController::class, 'unprivate'])->name('unprivate');

    Route::post('/like/{id}', [LikeController::class, 'like'])->name('like');
    Route::post('/unlike/{id}', [LikeController::class, 'unlike'])->name('unlike');
});
