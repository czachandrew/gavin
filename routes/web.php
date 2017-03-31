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

//Route::get('/', function () {
  //  return view('welcome');
//});

Route::get('/home', 'PagesController@home');

Route::get('/', 'PagesController@home');

Route::get('/new/facility', 'FacilityController@createForm');

Route::post('/new/facility', 'FacilityController@create');

Route::get('facility/details/{id}', 'FacilityController@details');

Route::post('/notepad/update/{id}','NotepadController@update');

Route::get('/possible', 'PagesController@possible');

Route::get('/facility/{id}/{call?}', 'PagesController@view'); 

Route::post('/facility/markit/{id}', 'PagesController@markIt');

Route::post('/facility/{id}', 'PagesController@addNote');

Route::post('/facility/{id}/addContact', 'PagesController@addContact');

Route::post('/add/facilities', 'FacilityController@add');

Route::get('/search/facilities', 'SearchController@index');

Route::post('/search/facilities', 'SearchController@search');

Route::post('/activities/create', 'ActivityController@create'); 

Route::get('/view/activities', 'ActivityController@dashboard');

Route::get('/activities/','ActivityController@getList');

Route::post('/activities/update/{id}','ActivityController@update');

Route::get('/activities/details/{id}', 'ActivityController@details');

Route::get('/activities/complete/{id}', 'ActivityController@complete');

Route::get('/users/list', 'DataController@users');

Route::get('/email/send', 'EmailController@send');



Auth::routes();

//