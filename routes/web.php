<?php

use App\Http\Controllers\HomeController;
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
    return view('auth.login');
})->middleware('guest');

Auth::routes();

Route::middleware('auth')->group(function(){

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::post('/create',[HomeController::class, 'create']);

    Route::post('/filter', [HomeController::class, 'filter']);

    Route::post('/filterMin', [HomeController::class, 'filterMin']);

    Route::post('/filterMax', [HomeController::class, 'filterMax']);

    Route::post('/import', [HomeController::class, 'import']);

});


