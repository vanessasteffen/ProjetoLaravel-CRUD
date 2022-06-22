<?php

use App\Http\Controllers\ClienteApiController;
use App\Http\Controllers\DocumentoApiController;
use App\Http\Controllers\ProdutoApiController;

//Route:: get('/clientes', [ClienteApiController::class, 'index']);

Route::get('clientes/{id}/documento', [ClienteApiController::class, 'documento']);
Route::get('documento/{id}/cliente', [DocumentoApiController::class, 'cliente']);

Route::get('produto/{id}/clientes', [ProdutoApiController::class, 'cliente']);
Route::get('clientes/{id}/produto', [ClienteApiController::class, 'produto']);
Route::apiResource('produto', ProdutoApiController::class);


Route:: apiResource('clientes', ClienteApiController::class);
Route:: apiResource('documento', DocumentoApiController::class);


