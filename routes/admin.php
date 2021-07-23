<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AntenaController;
use App\Http\Controllers\Admin\ServidorController;
use App\Http\Controllers\Admin\TorreController;
use App\Http\Controllers\Admin\TipoAntenaController;

Route::get('',[HomeController::class,'index']);

Route::resource('antena', AntenaController::class);

Route::resource('tipoantena', TipoAntenaController::class);

Route::resource('torre', TorreController::class);

Route::resource('servidor', ServidorController::class);
