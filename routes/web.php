<?php

use Illuminate\Support\Facades\Route;
use App\Mail\ContactoArapaTelecomunicaciones;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



// https://www.youtube.com/watch?v=e0ynchA_sBA&ab_channel=CodersFree
Route::get('contacto', function () {

    $correo= new ContactoArapaTelecomunicaciones;
    Mail::to('kidmeg200@hotmail.com')->send($correo);
    return "Mensaje enviado";
    
});
// Route::resource('servidor', ServidorController::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

