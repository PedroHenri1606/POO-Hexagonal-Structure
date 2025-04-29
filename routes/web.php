<?php

use App\Http\Controllers\API\UserControllerApi;
use App\Http\Controllers\WEB\UserControllerWeb;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/api'], function(){

    Route::group(['prefix' => '/v1'], function(){

        Route::group(['prefix' => 'users'], function(){

            Route::get('/{id}'     , [UserControllerApi::class, 'findById']);
            Route::get(''          , [UserControllerApi::class, 'findAll']);

            Route::post(''         , [UserControllerApi::class, 'create']);
            Route::put('/{id}'     , [UserControllerApi::class, 'update']);

            Route::delete('/{id}'  , [UserControllerApi::class, 'destroy']);
        });
    });
});


Route::group(['prefix' => '/app'], function(){

        Route::resource('users', UserControllerWeb::class)->names([
            'index'   => 'users.index',
            'create'  => 'users.create',
            'store'   => 'users.store',
            'show'    => 'users.show',
            'edit'    => 'users.edit',
            'update'  => 'users.update',
            'destroy' => 'users.destroy',
        ]);

});
