<?php
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization ");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Origin: *');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// group router use authenticate
Route::group(['prefix' => 'api/v1','middleware' => ['auth']], function()
{
/*    Route::controller('profile', 'ProfileController');
    Route::controller('artworks/material', 'artworks\ArtworkMaterialController');
    Route::controller('artworks/style', 'artworks\ArtworkStyleController');
    Route::controller('artworks/color', 'artworks\ArtworkColorController');
*/    
    Route::controller('products', 'Api\product\ProductController');
    Route::controller('category', 'Api\product\CategoryController');
    Route::controller('provider', 'Api\product\ProviderController');
    Route::controller('deal-pricing', 'Api\product\DealPricingController');
    Route::controller('slide'       , 'Api\SlideController');
    Route::controller('main', 'Api\MainController');
    Route::controller('uploader', 'UploaderController');
    Route::controller('page', 'Api\PageController');
    Route::controller('account', 'Api\AccountController');

    Route::controller('settings', 'Api\SettingsController');
    Route::controller('news', 'Api\NewsController');
    Route::controller('news-category', 'Api\news\GroupnewsController');

    
    
});

Route::get('/', 'User\HomeController@getindex');

Route::get('/bao-gia', 'Api\product\DealPricingController@getBaoGia');
Route::get('/tin-tuc', 'User\NewsController@index');
Route::get('tin-tuc/{slug}','User\NewsController@detail');
Route::get('danh-muc/{slug}','User\CategoryController@index');
Route::get('san-pham/{slug}','User\ProductController@detail');
Route::get('nhan-hieu/{slug}','User\BrandController@index');

Route::get('gioi-thieu','User\PageController@index');

Route::get('huong-dan-mua-hang','User\PageController@guide');  

Route::get('tu-van','User\PageController@advisory');

Route::get('tim-kiem','User\SearchController@index');

Route::get('/lien-he', 'User\ContactController@index');
Route::post('/lien-he', 'User\ContactController@insert');

// group router not use authenticate
Route::group(['prefix' => 'api/v1'],function() {
	Route::controller('login', 'Auth\LoginController');
});

