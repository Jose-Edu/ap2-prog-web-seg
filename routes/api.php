<?php

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendedorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/vendedores', [VendedorController::class, 'index']);
Route::get('/vendedores/{id}', [VendedorController::class, 'show']);
Route::post('/vendedores', [VendedorController::class, 'store']);
Route::put('/vendedores/{id}', [VendedorController::class, 'update']);
Route::delete('/vendedores/{id}', [VendedorController::class, 'destroy']);

Route::get('/produtos', [ProdutoController::class, 'index']);
Route::get('/produtos/{id}', [ProdutoController::class, 'show']);
Route::post('/produtos', [ProdutoController::class, 'store']);
Route::put('/produtos/{id}', [ProdutoController::class, 'update']);
Route::delete('/produtos/{id}', [ProdutoController::class, 'destroy']);
