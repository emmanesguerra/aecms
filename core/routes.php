<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


Route::prefix('admin')->group(function () {
    Route::get('/', function() {
        return redirect()->route('admin.login');
    });
    Route::get('/login', '\Core\Controller\AELoginController@showLoginForm')->name('admin.login');
    Route::post('/login', '\Core\Controller\AELoginController@login')->name('admin.login.post');
});

Route::get('/{slug?}', '\Core\Controller\AEController@index')->where('slug', '^(?!admin$).*$');