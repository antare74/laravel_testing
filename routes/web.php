<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Services\Google\AuthController as GoogleAuthController;
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
    return redirect('/dashboard');
    return view('welcome');
});



Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('/categories', CategoryController::class);
    Route::resource('/products', ProductController::class);
});

Route::get('/login/google', [GoogleAuthController::class, 'authRedirect'])->name('login.google');
Route::get('/callback/google', [GoogleAuthController::class, 'authHandler']);

require __DIR__.'/auth.php';
