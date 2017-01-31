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

Route::get('/home', 'HomeController@index');
Route::get('/test', 'testController@show');
Route::get('/homepage', 'homepageController@show');
Route::get('/search', 'searchController@search'); //this should become post
Route::put('/country', 'countryController@add');
Route::delete('/country/{id}', 'countryController@delete');
Route::patch('/country/{id}', 'countryController@update');
Route::get('/addCountry', function (){
    $countries = \App\country::all();
   return view('addCountry')->with(compact('countries'));
});
Route::put('/field', 'fieldController@add');
Route::delete('/field/{id}', 'fieldController@delete');
Route::patch('/field/{id}', 'fieldController@update');
Route::get('/addField', function (){
    $fields = \App\field::all();
    return view('addField')->with(compact('fields'));
});
Route::put('/organization', 'organizationController@add');
Route::delete('/organization/{id}', 'organizationController@delete');
Route::patch('/organization/{id}', 'organizationController@update');
Route::get('/addOrganization', function (){
    $organizations = \App\organization::with('country')->get();
    $countries = \App\country::all();
    return view('addOrganization')->with(compact('organizations', 'countries'));
});