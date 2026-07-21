<?php

use App\Http\Controllers\LibroController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('libros.index');
});

Route::resource('libros', LibroController::class);
