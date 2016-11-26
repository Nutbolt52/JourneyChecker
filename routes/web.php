<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'home@displaypage');
Route::get('preferences', 'preferences@displaypage');
Route::post('preferences', 'preferences@SetPreferences');
Route::get('preferences/delete', 'preferences@DeletePreferences');
Route::get('about', 'about@displaypage');
Route::post('contact', 'about@contact');

Route::get('api/update', 'api@updatelines');
Route::get('api/last-update', 'api@lastupdate');