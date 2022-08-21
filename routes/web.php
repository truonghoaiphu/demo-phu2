<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShareVideoController;
use App\Http\Controllers\LikeVideoController;

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


Route::get('/',[ShareVideoController::class, 'index']);

Route::post('/login',[UserController::class, 'login']);
Route::post('/logout',[UserController::class, 'logout']);

Route::group(['middleware' => 'UserLogin'], function() {
    Route::get('/share', function() {
        return view('share');
    });
    Route::post('/share-video',[ShareVideoController::class, 'store']);
    Route::post('/react',[LikeVideoController::class, 'react']);
});
