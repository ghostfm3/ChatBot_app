<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestApiController;

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

Route::get('/alpinetest', function() {
    return view('Alpine_test.alpinetest');
});

Route::get('/login_sc', function () {
    return view('login_sc');
});

Route::resource('test',TestApiController::class);
Route::delete('/test', [TestApiController::class, 'destroy'])->name('test.destroy');


