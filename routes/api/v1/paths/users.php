<?php

use App\Http\Controllers\Api\V1\Users\UserController;
use App\Http\Controllers\Api\V1\Users\UserLoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes Address
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(
    [
        'prefix' => 'users',
        'namespace' => 'Users',
        'middleware' => ['auth:sanctum', 'role:user'],
    ],
    function () {
        Route::get('/', [UserController::class, 'getAll']);

        Route::get('/{id}', [UserController::class, 'getById']);

        Route::post('/', [UserController::class, 'create']);

        Route::put('/{id}', [UserController::class, 'update']);

        Route::delete('/{id}', [UserController::class, 'delete']);

        Route::patch(
            '/{id}/password', [
                UserLoginController::class,
                'updatePassword',
        ]);
    }
);
Route::group(
    [
        'prefix' => 'user',
        'namespace' => 'LoginUsers'
    ],
    function () {
        Route::post('/register', [UserController::class, 'create']);

        Route::post('/login', [UserLoginController::class, 'login']);

        Route::post(
            '/password/email', [
                UserLoginController::class,
                'sendResetPasswordEmail',
        ])->name('password.reset');

        Route::post('/password/reset', [
            UserLoginController::class,
            'resetPassword',
        ]);
    }
);
