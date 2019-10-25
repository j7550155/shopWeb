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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/', 'UserAuthController@index');
    Route::group(['prefix' => 'auth'], function () {
        Route::get('/signUp', 'UserAuthController@signUpPage'); //註冊頁
        Route::post('/signUp', 'UserAuthController@signUp');
        Route::get('/login', 'UserAuthController@loginPage'); //登入頁
        Route::post('/login', 'UserAuthController@login');
        Route::get('/signOut', 'UserAuthController@signOut'); //登出
        Route::get('/own', ['middleware' => 'user', 'uses' => 'UserAuthController@own']); //會員中心
        Route::post('/ownEdit', ['middleware' => 'user', 'uses' => 'UserAuthController@ownEdit']); //改user資料
        Route::post('/edit', ['middleware' => 'admin', 'uses' => 'UserAuthController@edit']); //透過管理員改user資料
    });
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminController@index'); //管理員登入頁面
    Route::get('/home', ['middleware' => 'admin', 'uses' => 'AdminController@home']); //管理主頁
    Route::get('/allMember', ['middleware' => 'admin', 'uses' => 'AdminController@allMember']);
    Route::group(['prefix' => 'auth'], function () {
        // Route::get('/signUp', 'AdminController@signUpPage');
        // Route::post('/signUp', 'AdminController@signUp');
        // Route::get('/login', 'AdminController@loginPage');
        Route::post('/login', 'AdminController@login');
        // Route::get('/signOut', 'AdminController@signOut');
    });
});

Route::group(['prefix' => 'product'], function () {
    Route::get('/', 'ProductController@index'); //購物首頁
    Route::get('/cart', ['middleware' => 'user', 'uses' => 'ProductController@cart']); //結帳頁面
    Route::get('/pay', ['middleware' => 'user', 'uses' => 'ProductController@pay']); //結帳
    Route::get('/page', 'ProductController@productPage');
    Route::get('/all', 'ProductController@allProduct'); //全部product api
    Route::get('/{pid}', 'ProductController@product'); //單一product api
    Route::post('/edit/{pid}', ['middleware' => 'admin', 'uses' => 'ProductController@edit']); // 更改產品資訊
    Route::post('/createProduct', ['middleware' => 'admin', 'uses' => 'ProductController@createProduct']); //新增品項
});

Route::group(['prefix' => 'order'], function () {
    Route::get('/', 'OrderController@index'); //查看訂單
    Route::post('/edit/{oid}', ['middleware' => 'admin', 'uses' => 'OrderController@edit']); //更改訂單

});
