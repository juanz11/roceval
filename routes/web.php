<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ChoferController;

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

Route::post('/admin/solicitudes/{solicitud}/cotizar', [SolicitudController::class, 'guardarCotizacion'])
    ->name('admin.solicitudes.cotizar.guardar');

Route::get('/admin/historial', [SolicitudController::class, 'historial'])
    ->name('admin.solicitudes.historial');

Route::get('/admin/cotizaciones/{cotizacion}', [SolicitudController::class, 'verCotizacion'])
    ->name('admin.cotizaciones.show');

Route::get('/admin/choferes', [ChoferController::class, 'index'])->name('admin.choferes.index');
Route::get('/admin/choferes/create', [ChoferController::class, 'create'])->name('admin.choferes.create');
Route::post('/admin/choferes', [ChoferController::class, 'store'])->name('admin.choferes.store');
Route::get('/admin/choferes/{chofer}', [ChoferController::class, 'show'])->name('admin.choferes.show');
Route::get('/admin/choferes/{chofer}/edit', [ChoferController::class, 'edit'])->name('admin.choferes.edit');
Route::put('/admin/choferes/{chofer}', [ChoferController::class, 'update'])->name('admin.choferes.update');
Route::delete('/admin/choferes/{chofer}', [ChoferController::class, 'destroy'])->name('admin.choferes.destroy');
Route::delete('/admin/choferes/{chofer}/documentos/{documento}', [ChoferController::class, 'destroyDocumento'])->name('admin.choferes.documentos.destroy');
