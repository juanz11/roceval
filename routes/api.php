<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChoferController;
use App\Http\Controllers\Api\SolicitudController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::get('/choferes', [ChoferController::class, 'index']);
        Route::post('/choferes', [ChoferController::class, 'store']);
        Route::get('/choferes/{chofer}', [ChoferController::class, 'show']);
        Route::put('/choferes/{chofer}', [ChoferController::class, 'update']);
        Route::delete('/choferes/{chofer}', [ChoferController::class, 'destroy']);

        Route::get('/solicitudes', [SolicitudController::class, 'index']);
        Route::get('/solicitudes/historial', [SolicitudController::class, 'historial']);
        Route::get('/solicitudes/{solicitud}', [SolicitudController::class, 'show']);
        Route::post('/solicitudes/{solicitud}/aceptar', [SolicitudController::class, 'aceptar']);
        Route::post('/solicitudes/{solicitud}/rechazar', [SolicitudController::class, 'rechazar']);
        Route::post('/solicitudes/{solicitud}/cotizar', [SolicitudController::class, 'guardarCotizacion']);
    });
});
