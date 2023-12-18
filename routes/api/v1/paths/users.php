<?php

use App\Http\Controllers\Api\V1\Users\UserController;
use App\Http\Controllers\Api\V1\Users\UserLoginController;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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
            '/{id}/password',
            [
                UserLoginController::class,
                'updatePassword',
            ]
        );
    }
);

Route::group(
    [
        'prefix' => 'user',
        'namespace' => 'LoginUsers'
    ],
    function () {
        Route::post('/email/test', [UserController::class, 'testEmail'])
            ->name('users.testEmail');

        Route::post('/register', [UserController::class, 'create'])
            ->name('users.register');

        Route::post('/login', [UserLoginController::class, 'login'])
            ->name('users.login');

        Route::post(
            '/password/email',
            [
                UserLoginController::class,
                'sendResetPasswordEmail',
            ]
        )->name('password.reset');

        Route::post('/password/reset', [
            UserLoginController::class,
            'resetPassword',
        ]);
    }
);

Route::group(
    [
        'prefix' => 'mail',
        'namespace' => 'mailVerification',
        'middleware' => ['auth'],
    ],
    function () {
        Route::get('/verify', function () {
            return view('auth.verify-email');
            // })->middleware('auth')
        })->name('verification.notice');

        Route::get('/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
            $request->fulfill();
            return redirect('/home');
            // })->middleware(['auth', 'signed'])
        })->middleware(['signed'])
            ->name('verification.verify');

        Route::post(
            '/verification-notification',
            function (Request $request) {
                $request->user()->sendEmailVerificationNotification();
                return back()->with('message', 'Verification link sent!');
            }
            // )->middleware(['auth', 'throttle:6,1'])
            )->middleware(['throttle:6,1'])
            ->name('verification.send');
    }
);
