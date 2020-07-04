<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/category/{slug}', 'HomeController@viewByCat');
Route::get('/book/{slug}', 'HomeController@viewDetailBook');
Route::get('/search', 'HomeController@search');
Route::get('/user/{id}', 'HomeController@showInfo');
Route::get('/user/{id}/edit', 'HomeController@userEdit');
Route::put('/user/{id}', 'HomeController@userUpdate');
Route::get('/test', 'HomeController@testCart');
Route::get('/getbooks/{id}', 'HomeController@getBooks');
Route::get('/unbook/{id}', 'HomeController@unBook');
Route::get('/show-cart', 'HomeController@showCart');
Route::get('/handle-request', 'HomeController@requestBook');
Route::get('/history/{id}', 'HomeController@historyBook');
Route::put('/refund/{id}', 'HomeController@refundBook');
Route::get('/fillbook/{val}', 'HomeController@filterBook');

Route::group(['prefix'=>'admin', 'middleware'=>'checkadmin'],function () {
    Route::get('/', 'admin\AdminController@index');
    Route::resources(['book' => 'admin\BookController']);
    Route::resources(['category' => 'admin\CategoryController']);
    Route::resources(['slide' => 'admin\SlideController']);
    Route::resources(['order' => 'admin\GetBookController']);
    Route::put('/order/remove/{id}', 'admin\GetBookController@declineBook');
    Route::get('/refund/list', 'admin\GetBookController@listRefund');

    Route::put('/refund/list/{id}', 'admin\GetBookController@agreeBook');
    Route::resource('user', 'admin\UserController')->except([
        'create', 'store', 'update', 'destroy', 'edit', 'show'
    ]);
});
