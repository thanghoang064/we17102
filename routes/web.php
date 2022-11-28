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


// chỉ dùng đăng nhập
Route::get('/login',['as'=>'login','uses'=>'Auth\LoginConTroller@getLogin']);
Route::post('/login',['as'=>'login','uses'=>'Auth\LoginConTroller@postLogin']);

Route::get('/logout',['as'=>'logout','uses'=>'Auth\LoginConTroller@getLogout']);

Route::middleware(['auth'])->group(function (){
    //tất cả nhung duong link muon bao ve chi can đáp vào đây
    Route::get('/test',"TestController@index")->name('route_BackEnd_Test_index');
    Route::match(['get','post'],'/test/add',"TestController@add")->name('route_BackEnd_Test_add');

    Route::get('/test/detail/{id}','TestController@detail')
        ->name('route_BackEnd_Test_Detail');

    Route::post('/test/update/{id}','TestController@update')
        ->name('route_BackEnd_Test_Update');

});
