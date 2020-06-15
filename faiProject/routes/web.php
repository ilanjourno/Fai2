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

// There is a route for logout people
// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// There is routes for login people
Route::group(['middleware' => 'auth'], function () {
  // Profil routes
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
  // Fais & Domains routes
  Route::resource('fais', 'FaisController');
  Route::put('domains/{id}', ['as' => 'domains.update', 'uses' => 'FaisdomainController@update']);
  Route::delete('domains/{id}', ['as' => 'domains.delete', 'uses' => 'FaisdomainController@destroy']);

  // Addressees / Liste & Base routes
  Route::post('liste/create', 'ListeController@uploadEmail');
  Route::post('liste/upload', ['as' => 'liste.upload', 'uses' => 'ListeController@storeFile']);

  Route::resource('destinataire', 'DestinataireController');

  Route::post('destinataire', ['as' => 'destinataire.list', 'uses' => 'DestinataireController@list']);

  Route::get('sha', ['as' => 'sha.index', 'uses' => "ShaController@index"]);
  Route::post('sha', ['as' => 'sha.post', 'uses' => "ShaController@store"]);
  Route::post('sha/store', ['as' => 'sha.store', 'uses' => 'ShaController@storeFile']);

  Route::get('base/create', ['as' => 'base.create', 'uses' => 'BaseController@create']);
  Route::post('base/create', ['as' => 'base.store', 'uses' => 'BaseController@store']);
  Route::delete('base/{basename}', ['as' => 'base.delete', 'uses' => 'BaseController@destroy']);
});
