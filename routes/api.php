<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\EstadoController;
use App\Http\Controllers\Api\RegistroController;
use App\Http\Controllers\Api\ProveedorController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\UserRegistrosController;
use App\Http\Controllers\Api\EstadoRegistrosController;
use App\Http\Controllers\Api\ProveedorRegistrosController;

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

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('users', UserController::class);

        // User Registros
        Route::get('/users/{user}/registros', [
            UserRegistrosController::class,
            'index',
        ])->name('users.registros.index');
        Route::post('/users/{user}/registros', [
            UserRegistrosController::class,
            'store',
        ])->name('users.registros.store');

        Route::apiResource('estados', EstadoController::class);

        // Estado Registros
        Route::get('/estados/{estado}/registros', [
            EstadoRegistrosController::class,
            'index',
        ])->name('estados.registros.index');
        Route::post('/estados/{estado}/registros', [
            EstadoRegistrosController::class,
            'store',
        ])->name('estados.registros.store');

        Route::apiResource('proveedors', ProveedorController::class);

        // Proveedor Registros
        Route::get('/proveedors/{proveedor}/registros', [
            ProveedorRegistrosController::class,
            'index',
        ])->name('proveedors.registros.index');
        Route::post('/proveedors/{proveedor}/registros', [
            ProveedorRegistrosController::class,
            'store',
        ])->name('proveedors.registros.store');

        Route::apiResource('registros', RegistroController::class);
    });
