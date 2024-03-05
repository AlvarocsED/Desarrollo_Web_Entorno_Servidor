<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::controller(ViajesC::class)->group(function(){
    Route::get('Viajes','viajes')->name('verViajes');
});
Route::controller(ReservaC::class)->group(function(){    
    Route::get('reserva','reserva')->name('crearReserva');  
    Route::post('reserva/crear','crearReserva')->name('crearReserva');  
});
Route::controller(ViajesC::class)->group(function(){
    Route::get('viajes','viajes')->name('crearViajes');
    Route::post('viajes/crear','crearViaje')->name('crearViaje');
});
