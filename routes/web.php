<?php

use App\Http\Controllers\accountController;
use App\Http\Controllers\photocontroller;
use Illuminate\Support\Facades\Route;

Route::get('/', [photocontroller::class, 'index'])->name('photo.photo_index');


Route::group(['prefix'=>'account'], function(){
    Route::group(['middleware' => 'guest'], function(){
        Route::get('register', [accountController::class, 'register'])->name('account.register');
        Route::post('register', [accountController::class, 'processRegister'])->name('account.processregister');
        Route::get('login', [accountController::class, 'login'])->name('account.login');
        Route::post('login', [accountController::class, 'authenticate'])->name('account.authenticate');
    });
    Route::group(['middleware' => 'auth'], function(){
        Route::get('profile', [accountController::class, 'profile'])->name('account.profile');
        Route::get('logout', [accountController::class, 'logout'])->name('account.logout');
        Route::post('profile', [accountController::class, 'updateprofile'])->name('account.updateprofile');
    });
});

Route::group(['prefix'=>'photo'], function(){
    Route::group(['middleware' => 'guest'], function(){
        // Route::get('photo_index', [photocontroller::class, 'index'])->name('photo.photo_index');
    });
    Route::group(['middleware' => 'auth'], function(){
        Route::get('see_photo', [photocontroller::class, 'index'])->name('photo.see_photo');
        Route::get('see_photo', [photocontroller::class, 'see_photo'])->name('photo.see_photo');
        Route::get('create', [photocontroller::class, 'createpost'])->name('photo.createpost');
        Route::get('edit/{id}', [photocontroller::class, 'editpost'])->name('photo.editpost');
        Route::post('update', [photocontroller::class, 'update'])->name('photo.update');
        Route::delete('delete', [photocontroller::class, 'destroy'])->name('photo.destroy');
        Route::post('', [photocontroller::class, 'add_photo'])->name('photo.add_photo');
        Route::get('photo_details/{id}', [photocontroller::class, 'photo_details'])->name('photo.photo_details');
        Route::get('photo_index', [photocontroller::class, 'photo_index'])->name('photo.photo_index');
    });
});
