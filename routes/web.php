<?php

use App\Http\Controllers\DocumentsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DocumentsController::class, 'Importar'])->name('importar');
Route::post('/importar/arquivo', [DocumentsController::class, 'ImportarAqquivo'])->name('importar.arquivo');
Route::get('/processar/fila', [DocumentsController::class, 'ProcessarFila'])->name('processar.fila');
