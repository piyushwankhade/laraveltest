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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('test',function(){
	return "Test Hello";
});


Route::group(['prefix' => 'admin','middleware' => 'auth'],function(){


	# Article Category...
	Route::resource('article_categories', 'ArticleCategoryController');
	Route::get('article_categories/{articleCategory}/delete','ArticleCategoryController@delete')->name('article_categories.delete');
	Route::get('article_categories/{articleCategory}/status','ArticleCategoryController@status')->name('article_categories.status');
	Route::get('article_categories/{articleCategory}/approval','ArticleCategoryController@approval')->name('article_categories.approval');

	
	

});


