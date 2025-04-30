<?php

use App\Http\Controllers\WEB\AuthWebController;
use App\Http\Controllers\WEB\UserWebController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/app'], function(){

    Route::get('/login',  [AuthWebController::class, 'index'])->name('login.index');
    Route::post('/login', [AuthWebController::class, 'login'])->name('login.login');

    Route::middleware(['auth:web'])->group(function() {

        Route::delete('/logout', [AuthWebController::class, 'logout'])->name('login.logout');

        Route::resource('users', UserWebController::class)->names([
            'index'   => 'users.index',
            'create'  => 'users.create',
            'store'   => 'users.store',
            'show'    => 'users.show',
            'edit'    => 'users.edit',
            'update'  => 'users.update',
            'destroy' => 'users.destroy',
        ]);
    });
});
