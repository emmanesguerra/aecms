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
    
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', '\Core\Controller\AEHomeController@index')->name('admin.home');
        Route::get('/logout', '\Core\Controller\AELoginController@logout')->name('admin.logout');

        Route::prefix('users')->group(function () {
            Route::get('/', '\Core\Controller\User\UserController@index')->name('user.index');
            Route::get('/data', '\Core\Controller\User\UserController@data')->name('user.data');
            Route::get('/{id}', '\Core\Controller\User\UserController@show')->name('user.show');
            Route::post('/', '\Core\Controller\User\UserController@store')->name('user.store');
            Route::put('/', '\Core\Controller\User\UserController@update')->name('user.update');
            Route::delete('/{id}', '\Core\Controller\User\UserController@destroy')->name('user.destroy');
        });

        Route::prefix('settings')->group(function () {
            Route::get('/', '\Core\Controller\Setting\SettingController@index')->name('setting.index');
            Route::post('/', '\Core\Controller\Setting\SettingController@store')->name('setting.store');
        });

        Route::prefix('modules')->group(function () {
            Route::get('/', '\Core\Controller\Modules\ModuleController@index')->name('module.index');
            Route::get('/data', '\Core\Controller\Modules\ModuleController@data')->name('module.data');
            Route::post('/', '\Core\Controller\Modules\ModuleController@store')->name('module.store');
            Route::delete('/{id}', '\Core\Controller\Modules\ModuleController@destroy')->name('module.destroy');
        });

        Route::prefix('permissions')->group(function () {
            Route::get('/', '\Core\Controller\User\PermissionController@index')->name('permission.index');
            Route::get('/{id}', '\Core\Controller\User\PermissionController@getPermission')->name('permission.getdata');
            Route::post('/', '\Core\Controller\User\PermissionController@store')->name('permission.store');
        });

        Route::prefix('navigations')->group(function () {
            Route::get('/', '\Core\Controller\Navigation\NavigationController@index')->name('navigation.index');
            Route::get('/data', '\Core\Controller\Navigation\NavigationController@data')->name('navigation.getdata');
            Route::post('/', '\Core\Controller\Navigation\NavigationController@store')->name('navigation.store');
            Route::put('/', '\Core\Controller\Navigation\NavigationController@update')->name('navigation.update');
            Route::delete('/', '\Core\Controller\Navigation\NavigationController@destroy')->name('navigation.destroy');
        });

        Route::prefix('pages')->group(function () {
            Route::get('/', '\Core\Controller\Page\PageController@index')->name('page.index');
            Route::get('/data', '\Core\Controller\Page\PageController@data')->name('page.data');
            Route::post('/template', '\Core\Controller\Page\PageController@template')->name('page.template');
            Route::get('/{id}', '\Core\Controller\Page\PageController@show')->name('page.show');
            Route::post('/', '\Core\Controller\Page\PageController@store')->name('page.store');
            Route::put('/', '\Core\Controller\Page\PageController@update')->name('page.update');
            Route::delete('/{id}', '\Core\Controller\Page\PageController@destroy')->name('page.destroy');
        });

        Route::prefix('contents')->group(function () {
            Route::get('/', '\Core\Controller\Content\ContentController@index')->name('maincontents.index');
            Route::get('/data', '\Core\Controller\Content\ContentController@data')->name('maincontents.data');
            Route::get('/{id}', '\Core\Controller\Content\ContentController@show')->name('maincontents.show');
            Route::post('/', '\Core\Controller\Content\ContentController@store')->name('maincontents.store');
            Route::put('/', '\Core\Controller\Content\ContentController@update')->name('maincontents.update');
            Route::delete('/{id}', '\Core\Controller\Content\ContentController@destroy')->name('maincontents.destroy');
        });

        Route::prefix('panels')->group(function () {
            Route::get('/', '\Core\Controller\Content\PanelController@index')->name('panels.index');
            Route::get('/data', '\Core\Controller\Content\PanelController@data')->name('panels.data');
            Route::get('/{id}', '\Core\Controller\Content\PanelController@show')->name('panels.show');
            Route::post('/', '\Core\Controller\Content\PanelController@store')->name('panels.store');
            Route::put('/', '\Core\Controller\Content\PanelController@update')->name('panels.update');
            Route::delete('/{id}', '\Core\Controller\Content\PanelController@destroy')->name('panels.destroy');
        });

        Route::prefix('files')->group(function () {
            Route::get('/', '\Core\Controller\Uploads\FileController@index')->name('files.index');
            Route::get('/process/{type?}', '\Core\Controller\Uploads\FileController@filedata')->name('files.process.get');
            Route::post('/process', '\Core\Controller\Uploads\FileController@filearchived')->name('files.process.post');
            Route::put('/process', '\Core\Controller\Uploads\FileController@filerestore')->name('files.process.put');
            Route::delete('/process', '\Core\Controller\Uploads\FileController@filedelete')->name('files.process.delete');
            Route::get('/{id}', '\Core\Controller\Uploads\FileController@show')->name('files.show');
            Route::post('/', '\Core\Controller\Uploads\FileController@store')->name('files.store');
            Route::put('/', '\Core\Controller\Uploads\FileController@update')->name('files.update');
            Route::delete('/{id}', '\Core\Controller\Uploads\FileController@destroy')->name('files.destroy');
            Route::post('/upload', '\Core\Controller\Uploads\FileController@upload')->name('files.upload');
        });

        Route::prefix('contactus')->group(function () {
            Route::get('/', '\Core\Controller\ContactUs\ContactUsController@index')->name('contactus.index');
            Route::get('/data', '\Core\Controller\ContactUs\ContactUsController@data')->name('contactus.data');
            Route::get('/{id}', '\Core\Controller\ContactUs\ContactUsController@show')->name('contactus.show');
            Route::post('/', '\Core\Controller\ContactUs\ContactUsController@store')->name('contactus.store');
            Route::put('/', '\Core\Controller\ContactUs\ContactUsController@update')->name('contactus.update');
            Route::delete('/{id}', '\Core\Controller\ContactUs\ContactUsController@destroy')->name('contactus.destroy');
        });
    });
});

Route::get('/{slug?}', '\Core\Controller\AEController@index')->where('slug', '^(?!admin$).*$');