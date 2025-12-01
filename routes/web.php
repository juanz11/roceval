<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SolicitudController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/formulario', function () {
    return view('formulario');
})->name('formulario.show');

Route::post('/formulario', [SolicitudController::class, 'store'])
    ->name('formulario.enviar');

Route::get('/admin/solicitudes', [SolicitudController::class, 'index'])
    ->name('admin.solicitudes.index');

Route::post('/admin/solicitudes/{solicitud}/aceptar', [SolicitudController::class, 'aceptar'])
    ->name('admin.solicitudes.aceptar');

Route::post('/admin/solicitudes/{solicitud}/rechazar', [SolicitudController::class, 'rechazar'])
    ->name('admin.solicitudes.rechazar');
