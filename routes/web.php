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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

/*
| -------------------------------------------------------------------------------------------------------
| Dashboard 
| -------------------------------------------------------------------------------------------------------
*/
Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard', 'middleware' => 'auth'], function()
{
    /*
     | -------------------------------------------------------------------------------------------------------
     | Dashboard Index 
     | -------------------------------------------------------------------------------------------------------
     */
    Route::get('/', [
        'uses'  => 'DashboardController@index',
        'as'    => 'dashboard.index'
    ]);
    
    /*
     | -------------------------------------------------------------------------------------------------------
     | User Profile 
     | -------------------------------------------------------------------------------------------------------
     */
    Route::get('user', [
        'uses'  => 'DashboardController@user',
        'as'    => 'dashboard.user'
    ]);
    
    /*
     | -------------------------------------------------------------------------------------------------------
     | Scrape 
     | -------------------------------------------------------------------------------------------------------
     */
    Route::get('scrape', [
        'uses'  => 'DashboardController@scrape',
        'as'    => 'dashboard.scrape'
    ]);

    Route::post('scrape', [
        'uses'  => 'ScrapeItemController@scrape',
        'as'    => 'dashboard.scrape-item'
    ]);

    Route::post('scrape/store', [
        'uses'  => 'ScrapeItemController@store',
        'as'    => 'dashboard.scrape-store'
    ]);

    /*
     | -------------------------------------------------------------------------------------------------------
     | Items 
     | -------------------------------------------------------------------------------------------------------
     */
    Route::get('items', [
        'uses'  => 'ItemController@index',
        'as'    => 'dashboard.items'
    ]);

    Route::get('items/{sku}', [
        'uses'  => 'ItemController@show',
        'as'    => 'dashboard.items.show'
    ]);
});

Auth::routes();
