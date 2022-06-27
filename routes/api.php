<?php

use App\Http\Controllers\ClienteApiController;
use App\Http\Controllers\DocumentoApiController;
use App\Http\Controllers\ProdutoApiController;
use App\Http\Controllers\AuthenticateController;

//Route:: get('/clientes', [ClienteApiController::class, 'index']);

//rotas de login
Route::post('login', [AuthenticateController::class,'authenticate']);
Route::post('login-refresh', [AuthenticateController::class,'refreshToken']);
Route::get('me', [AuthenticateController::class,'getAuthenticatedUser']);
//teste aqui


//Route::group(['middleware' => 'auth:api'],
//function() {
//Rotas de cliente
    Route::get('clientes/{id}/documento', [ClienteApiController::class, 'documento']);
    Route::get('clientes/{id}/produto', [ClienteApiController::class, 'produto']);
    Route:: apiResource('clientes', ClienteApiController::class);

//rotas de documento
    Route::get('documento/{id}/cliente', [DocumentoApiController::class, 'cliente']);
    Route:: apiResource('documento', DocumentoApiController::class);

//rotas de produto
    Route::get('produto/{id}/clientes', [ProdutoApiController::class, 'cliente']);
    Route::apiResource('produto', ProdutoApiController::class);
//});



