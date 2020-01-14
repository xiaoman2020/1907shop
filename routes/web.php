<?php

Route::get('/', function () {
    return view('welcome');
});

//品牌路由
Route::prefix('brand')->middleware('checklogin')->group(function(){

    Route::get('create','BrandController@create');
    Route::post('store','BrandController@store');
    Route::get('/','BrandController@index');
    Route::get('edit/{id}','BrandController@edit');
    Route::post('update/{id}','BrandController@update');
    Route::get('del/{id}','BrandController@destroy');
    Route::get('checkOnly','BrandController@checkOnly');
});

//分类路由
Route::prefix('category')->group(function(){

    Route::get('create','CategoryController@create');
    Route::post('store','CategoryController@store');
    Route::get('/','CategoryController@index');
    Route::get('edit/{id}','CategoryController@edit');
    Route::post('update/{id}','CategoryController@update');
    Route::get('del/{id}','CategoryController@destroy');


});

//登录路由
Route::view('/login','admin.login.login');
Route::post('/dologin','LoginController@dologin');
Route::get('/logout','LoginController@logout');

//商品路由
Route::prefix('goods')->middleware('checklogin')->group(function(){

    Route::get('create','GoodsController@create');
    Route::post('store','GoodsController@store');
    Route::get('/','GoodsController@index');
    Route::get('edit/{id}','GoodsController@edit');
    Route::post('update/{id}','GoodsController@update');
    Route::get('del/{id}','GoodsControllerr@destroy');
    Route::get('show/{id}','GoodsController@show');
    Route::post('addcart','GoodsController@addcart');
    Route::get('show/{id}','GoodsController@show');
});

//售楼路由
Route::prefix('area')->group(function(){

    Route::get('create','AreaController@create');
    Route::post('store','AreaController@store');
    Route::get('/','AreaController@index');
    Route::get('del/{id}','AreaController@destroy');
    Route::get('show/{id}','AreaController@show');

});

//发送邮件
Route::get('/send','MailController@sendemail');







