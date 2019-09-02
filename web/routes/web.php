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

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/category', 'CategoryController@index')->middleware('auth');
Route::get('/category/new', 'CategoryController@category_new')->middleware('auth');
Route::get('/category/{id}', 'CategoryController@category')->middleware('auth');
Route::post('/category/{id}', 'CategoryController@postCategory')->middleware('auth');
Route::delete('/category/{id}', 'CategoryController@deleteCategory')->middleware('auth');
Route::post('/category/{id}/search', 'CategoryController@searchReviewCategory')->middleware('auth');
Route::post('/category/{id}/review/{review_id}', 'CategoryController@postAddCategoryReview')->middleware('auth');
Route::delete('/category/{id}/review/{review_id}', 'CategoryController@postDeleteCategoryReview')->middleware('auth');
