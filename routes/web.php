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


//----------------------------------------------
#         Homepage and Search Routes
//----------------------------------------------


Route::get('/homepage', 'homepageController@show');
Route::post('/search', 'searchController@search'); //this should become post


//----------------------------------------------
#               Country Routes
//----------------------------------------------

Route::put('/country', 'countryController@add');
Route::delete('/country/{id}', 'countryController@delete');
Route::patch('/country/{id}', 'countryController@update');
Route::get('/addCountry', function (){
    $countries = \App\country::all();
   return view('addCountry')->with(compact('countries'));
});

//----------------------------------------------
#               Field(Research area) Routes
//----------------------------------------------


Route::put('/field', 'fieldController@add');
Route::delete('/field/{id}', 'fieldController@delete');
Route::patch('/field/{id}', 'fieldController@update');
Route::get('/addField', function (){
    $fields = \App\field::all();
    return view('addField')->with(compact('fields'));
});

//----------------------------------------------
#               Organization Routes
//----------------------------------------------


Route::put('/organization', 'organizationController@add');
Route::delete('/organization/{id}', 'organizationController@delete');
Route::patch('/organization/{id}', 'organizationController@update');
Route::get('/addOrganization', function (){
    $organizations = \App\organization::with('country')->get();
    $countries = \App\country::all();
    return view('addOrganization')->with(compact('organizations', 'countries'));
});


//----------------------------------------------
#               Category(Tag) Routes
//----------------------------------------------


Route::put('/category', 'categoryController@add');
Route::delete('/category/{id}', 'categoryController@delete');
Route::patch('/category/{id}', 'categoryController@update');
Route::get('/addCategory', function (){
    $categories = \App\tag::orderBy('real')->get();
    return view('addCategory')->with(compact('categories'));
});

//----------------------------------------------
#               Fund Routes
//----------------------------------------------


Route::put('/fund', 'fundController@add');
Route::patch('/fund/{id}', 'fundController@update');
Route::get('/fund/{id}', 'fundController@show')->middleware('auth');
Route::delete('/fund/{id}', 'fundController@del');
Route::post('/newFund', 'fundController@newFund');
Route::get('/addFund', function (){
    return view('addFund');
});


//----------------------------------------------
#               Import Routes
//----------------------------------------------


Route::get('/import', 'importController@show');
Route::post('/import', 'importController@import');


//----------------------------------------------
#               Admin Routes
//----------------------------------------------
Route::get('adminPanel', 'adminController@show')->middleware('admin');
Route::post('adminPanel', 'adminController@register')->middleware('admin');
Route::post('/users/{id}', 'adminController@setUnsetAdmin')->middleware('admin');
Route::delete('/users/{id}', 'adminController@deleteUser')->middleware('admin');



