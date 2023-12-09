<?php

use App\Http\Controllers\Api\V1\Digimons\DigimonController;
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
        'prefix' => 'digimons',
        'namespace' => 'Digimons',
        // 'middleware' => ['auth:sanctum', 'role:user'],
    ],
    function () {
        Route::get('/', [DigimonController::class, 'getAll']);

        Route::get('/{id}', [DigimonController::class, 'getByParameter']);

        // Route::post('/', [DigimonController::class, 'create']);

        // Route::put('/{id}', [DigimonController::class, 'update']);

        // Route::delete('/{id}', [DigimonController::class, 'delete']);
    }
);
