<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

// La raíz lleva a /home (si no hay sesión, Laravel manda al login)
Route::redirect('/', '/home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// CRUD de clientes: index, create, store, edit, update, destroy
Route::middleware('auth')->group(function () {
    Route::resource('clientes', ClienteController::class)
        ->except('show')
        ->parameters(['clientes' => 'cliente']);
});
