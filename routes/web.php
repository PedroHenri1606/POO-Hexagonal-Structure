<?php

use App\Http\ApiControllers\UserApiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/api'], function(){

    Route::group(['prefix' => '/v1'], function(){

        Route::group(['prefix' => 'users'], function(){

            Route::get('/{id}'     , [UserApiController::class, 'findById']);
            Route::get(''          , [UserApiController::class, 'findAll']);

            Route::post(''         , [UserApiController::class, 'create']);
            Route::put('/{id}'     , [UserApiController::class, 'update']);

            Route::delete('/{id}'  , [UserApiController::class, 'destroy']);
        });
    });
});


Route::group(['prefix' => '/app'], function(){

        Route::resource('users', UserController::class)->names([
            'index'   => 'users.index',
            'create'  => 'users.create',
            'store'   => 'users.store',
            'show'    => 'users.show',
            'edit'    => 'users.edit',
            'update'  => 'users.update',
            'destroy' => 'users.destroy',
        ]);

});
