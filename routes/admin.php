<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AntenaController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\DatacenterController;
use App\Http\Controllers\Admin\GponController;
use App\Http\Controllers\Admin\NapController;
use App\Http\Controllers\Admin\OltController;
use App\Http\Controllers\Admin\PagoController;
use App\Http\Controllers\Admin\ServidorController;
use App\Http\Controllers\Admin\TarjetaController;
use App\Http\Controllers\Admin\TorreController;
use App\Http\Controllers\Admin\TipoAntenaController;

Route::get('', [HomeController::class, 'index']);

Route::resource('antena', AntenaController::class);

Route::resource('cliente', ClienteController::class);

Route::resource('pago', PagoController::class);

Route::resource('tipoantena', TipoAntenaController::class);

Route::resource('torre', TorreController::class);

Route::resource('servidor', ServidorController::class);

Route::resource('datacenter', DatacenterController::class);

Route::resource('olt', OltController::class);

Route::resource('tarjeta', TarjetaController::class);

Route::resource('gpon', GponController::class);

Route::resource('nap', NapController::class);
