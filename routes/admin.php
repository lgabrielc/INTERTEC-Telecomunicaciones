<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\PagoController;
use App\Http\Controllers\Admin\GestionarReportesController;
use App\Http\Controllers\admin\HerramientaController;
use App\Http\Controllers\Admin\GestionarServicioController;
use App\Http\Controllers\Admin\RecursosAntenaController;
use App\Http\Controllers\Admin\RecursosFibraController;

Route::get('', [HomeController::class, 'index']);

Route::prefix('recursosantena')->group(function () {
    Route::get('/servidor', [RecursosAntenaController::class, 'servidor']);
    Route::get('/torre', [RecursosAntenaController::class, 'torre']);
    Route::get('/antena', [RecursosAntenaController::class, 'antena']);
});

Route::prefix('recursosfibra')->group(function () {
    Route::get('/datacenter', [RecursosFibraController::class, 'datacenter']);
    Route::get('/olt', [RecursosFibraController::class, 'olt']);
    Route::get('/tarjeta', [RecursosFibraController::class, 'tarjeta']);
    Route::get('/gpon', [RecursosFibraController::class, 'gpon']);
    Route::get('/nap', [RecursosFibraController::class, 'nap']);
});
Route::prefix('gestionarreportes')->group(function () {
    Route::get('/pagocliente', [GestionarReportesController::class, 'pagocliente']);
    Route::get('/reportepagos', [GestionarReportesController::class, 'reportepagos']);
});

Route::prefix('gestionarservicio')->group(function () {
    Route::get('/cortarservicio', [GestionarServicioController::class, 'cortarservicio']);
    Route::get('/activarcliente', [GestionarservicioController::class, 'activarcliente']);
    Route::get('/habilitarservicio', [GestionarservicioController::class, 'habilitarservicio']);
    Route::get('/congelarservicio', [GestionarservicioController::class, 'congelarservicio']);
    Route::get('/descongelarservicio', [GestionarservicioController::class, 'descongelarservicio']);
    Route::get('/regresarcorte', [GestionarservicioController::class, 'regresaracorte']);
});
// Route::resource('antena', AntenaController::class);

Route::resource('cliente', ClienteController::class);
Route::resource('pago', PagoController::class);

Route::resource('herramienta', HerramientaController::class)->parameters(["herramienta" => "herramienta"]);
