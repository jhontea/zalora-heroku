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

// use Mail;
// use App\Services\ItemPriceLogs\PriceChangeService;
use App\Services\Items\ItemScrapeService;

Route::get('/', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
// Route::get('email', function() {
//     $data = array('name'=>"Virat Gandhi");
   
//     Mail::send('emails.welcome', $data, function($message) {
//         $message->to('hafizhipb49@gmail.com', 'Tutorials Point')->subject('Laravel HTML Testing Mail');
//         $message->from('sibodatbodat@gmail.com', 'Zalora Sendgrid');
//      });
//      echo "HTML Email Sent. Check your inbox.";
// });

Route::get('test', function() {
    // get DOM element
    $itemScrapeService = new ItemScrapeService();

    // scrap brand carvil
    $url = 'https://www.zalora.co.id/carvil';
    $query = ['page' => 3];
    $result = $itemScrapeService->brandScrape($url, $query);
    dd($url, $result);
    return response()->json($result);
});


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
     | Update log 
     | -------------------------------------------------------------------------------------------------------
     */
    Route::get('update-log', [
        'uses'  => 'DashboardController@updateLog',
        'as'    => 'dashboard.update-log'
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
