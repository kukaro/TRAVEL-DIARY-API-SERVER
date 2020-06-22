<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::get('/user', function (Request $request) {
//     dump($request);
//     return $request->user();
// });

Route::get('/user/{email}', 'UserController@get')->name('uaer\get');
Route::post('/user', 'UserController@post')->name('uaer\post');
Route::patch('/user/{email}', 'UserController@patch')->name('uaer\patch');
Route::delete('/user/{email}', 'UserController@delete')->name('uaer\delete');

Route::get('/health', function (Request $request) {
    return ['MSG' => 'OK', 'STATUS' => 200];
});
