<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\AuthController;
use App\Http\Controllers\API\v1\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::group(['prefix' => 'v1'], function () {
    Route::post('/register', [AuthController::class, 'register'])
        ->name('register');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login');
});

Route::group(['prefix' => 'v1', 'middleware' => ['auth:api']], function () {
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::group(['middleware' => ['app.permission']], function () {

        Route::get('/users', [UserController::class, 'index'])
            ->name('users.index');
            
        Route::get('/users/{id}', [UserController::class, 'show'])
            ->name('users.show');
    });
});
