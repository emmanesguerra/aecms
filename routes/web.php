<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */


Route::prefix('admin')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::prefix('sliders')->group(function () {
            Route::get('/', '\App\Http\Controllers\Sliders\Admin\AdminController@index')->name('sliders.index');
            Route::get('/data', '\App\Http\Controllers\Sliders\Admin\AdminController@data')->name('sliders.data');
            Route::get('/{id}', '\App\Http\Controllers\Sliders\Admin\AdminController@show')->name('sliders.show');
            Route::post('/', '\App\Http\Controllers\Sliders\Admin\AdminController@store')->name('sliders.store');
            Route::post('/upload', '\App\Http\Controllers\Sliders\Admin\AdminController@upload')->name('sliders.upload');
            Route::put('/', '\App\Http\Controllers\Sliders\Admin\AdminController@update')->name('sliders.update');
            Route::delete('/{id}', '\App\Http\Controllers\Sliders\Admin\AdminController@destroy')->name('sliders.destroy');
        });
        
        
        Route::prefix('products')->group(function () {
            Route::get('/', '\App\Http\Controllers\Products\Admin\AdminController@index')->name('products.index');
            Route::get('/data', '\App\Http\Controllers\Products\Admin\AdminController@data')->name('products.data');
            Route::get('/{id}', '\App\Http\Controllers\Products\Admin\AdminController@show')->name('products.show');
            Route::post('/', '\App\Http\Controllers\Products\Admin\AdminController@store')->name('products.store');
            Route::put('/', '\App\Http\Controllers\Products\Admin\AdminController@update')->name('products.update');
            Route::delete('/{id}', '\App\Http\Controllers\Products\Admin\AdminController@destroy')->name('products.destroy');
            
            Route::prefix('options')->group(function () {
                Route::get('/products', '\App\Http\Controllers\Products\Admin\AdminController@getProductOptions')->name('products.options.product');
                Route::get('/categories', '\App\Http\Controllers\Products\Admin\CategoryController@getCategoryOptions')->name('products.options.category');
            });
            
            Route::prefix('category')->group(function () {
                Route::get('/', '\App\Http\Controllers\Products\Admin\CategoryController@index')->name('category.index');
                Route::get('/data', '\App\Http\Controllers\Products\Admin\CategoryController@data')->name('category.data');
                Route::get('/{id}', '\App\Http\Controllers\Products\Admin\CategoryController@show')->name('category.show');
                Route::post('/', '\App\Http\Controllers\Products\Admin\CategoryController@store')->name('category.store');
                Route::put('/', '\App\Http\Controllers\Products\Admin\CategoryController@update')->name('category.update');
                Route::delete('/{id}', '\App\Http\Controllers\Products\Admin\CategoryController@destroy')->name('category.destroy');
            });
            
            Route::prefix('upload')->group(function () {
                Route::post('/upload-category', '\App\Http\Controllers\Products\Admin\ImageController@upload')->name('products.upload.images');
                Route::post('/upload', '\App\Http\Controllers\Products\Admin\ImageController@upload')->name('products.upload');
            });
        });
        
        Route::prefix('contactus')->group(function() {
            Route::post('/post', '\App\Http\Controllers\ContactUs\ContactUsController@post')->name('web.contactus.post');
        });
    });
});
