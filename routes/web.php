<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\AdminAuthController;

Route::get('/', function () {
    return view('home');
});

Route::get('/formulario', function () {
    return view('formulario');
})->name('formulario.show');

Route::post('/formulario', [SolicitudController::class, 'store'])
    ->name('formulario.enviar');

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])
    ->name('admin.login.show');

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login');

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->name('admin.logout');

Route::get('/admin/solicitudes', [SolicitudController::class, 'index'])
    ->name('admin.solicitudes.index');

Route::post('/admin/solicitudes/{solicitud}/aceptar', [SolicitudController::class, 'aceptar'])
    ->name('admin.solicitudes.aceptar');

Route::post('/admin/solicitudes/{solicitud}/rechazar', [SolicitudController::class, 'rechazar'])
    ->name('admin.solicitudes.rechazar');

Route::get('/admin/solicitudes/{solicitud}/cotizar', [SolicitudController::class, 'cotizar'])
    ->name('admin.solicitudes.cotizar');
