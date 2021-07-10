<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Auth\AuthenticateController;
use \App\Http\Controllers\Admin\ProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login', [AuthenticateController::class, 'authenticate']);
Route::get('unauthorized', [AuthenticateController::class, 'unauthorized'])->name('unauthorized');

Route::group(['middleware' => 'auth:api'], function () {
    Route::resource('profile', ProfileController::class);

});
