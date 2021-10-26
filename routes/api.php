<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TweetController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\SignupController;
use App\Http\Resources\UserResource;
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

Route::post('signup', SignupController::class);
Route::post('login', LoginController::class);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('tweets', [TweetController::class, 'store']);
    Route::get('timeline', [TweetController::class, 'timeline']);
    Route::post('users/follow', [UserController::class, 'follow']);

    Route::get('users/me', function (Request $request) {
        return new UserResource($request->user());
    });
});

