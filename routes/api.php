<?php

use App\Http\Controllers\API\AuthApiController;
use App\Http\Controllers\API\UserApiController;


Route::group(['prefix' => '/v1'], function(){

    Route::post('/auth', [AuthApiController::class, 'login']);

    Route::middleware(['auth:api'])->group(function(){

        Route::group(['prefix' => 'auth'], function(){

            Route::get('/'         , [AuthApiController::class, 'getTokenPayload']);
            Route::get('/check'    , [AuthApiController::class, 'checkToken']);

            Route::post('/refresh' , [AuthApiController::class, 'refreshToken']);

            Route::delete('/'      , [AuthApiController::class, 'logout']);
        });

        Route::group(['prefix' => 'users'], function(){

            Route::get('/{id}'     , [UserApiController::class, 'findById']);
            Route::get('/'         , [UserApiController::class, 'findAll']);

            Route::post('/'        , [UserApiController::class, 'create']);
            Route::put('/{id}'     , [UserApiController::class, 'update']);

            Route::delete('/{id}'  , [UserApiController::class, 'destroy']);
        });
    });
});

