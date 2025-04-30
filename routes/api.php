<?php

use App\Http\Controllers\API\AuthControllerApi;
use App\Http\Controllers\API\UserControllerApi;


Route::group(['prefix' => '/v1'], function(){

    Route::post('/auth', [AuthControllerApi::class, 'login']);

    Route::middleware(['auth:api'])->group(function(){

        Route::group(['prefix' => 'auth'], function(){

            Route::get('/'         , [AuthControllerApi::class, 'getTokenPayload']);
            Route::get('/check'    , [AuthControllerApi::class, 'checkToken']);

            Route::post('/refresh' , [AuthControllerApi::class, 'refreshToken']);

            Route::delete('/'      , [AuthControllerApi::class, 'logout']);
        });

        Route::group(['prefix' => 'users'], function(){

            Route::get('/{id}'     , [UserControllerApi::class, 'findById']);
            Route::get('/'         , [UserControllerApi::class, 'findAll']);

            Route::post('/'        , [UserControllerApi::class, 'create']);
            Route::put('/{id}'     , [UserControllerApi::class, 'update']);

            Route::delete('/{id}'  , [UserControllerApi::class, 'destroy']);
        });
    });
});

