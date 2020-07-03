<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Model\User;
use App\Model\Picture;

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

Route::post('/login', 'JWTAuthController@login')->name('api.jwt.login');
Route::middleware('auth:api')->get('/user', 'JWTAuthController@user')->name('api.jwt.user');
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('user', 'JWTAuthController@user')->name('api.jwt.user');
});

Route::get('/user/{email}', 'UserController@get')->name('uaer\get');
Route::post('/user', 'UserController@post')->name('uaer\post');
Route::patch('/user/{email}', 'UserController@patch')->name('uaer\patch');
Route::delete('/user/{email}', 'UserController@delete')->name('uaer\delete');

Route::get('/picture/{id}', 'PictureController@get')->name('picture\get');
Route::post('/picture', 'PictureController@post')->name('picture\post');
Route::patch('/picture/{id}', 'PictureController@patch')->name('picture\patch');
Route::delete('/picture/{id}', 'PictureController@delete')->name('picture\delete');

Route::get('/post/{id}', 'PostController@get')->name('post\get');
Route::post('/post', 'PostController@post')->name('post\post');
Route::patch('/post/{id}', 'PostController@patch')->name('post\patch');
Route::delete('/post/{id}', 'PostController@delete')->name('post\delete');
Route::get('/post/user/{id}', 'PostController@getWithUser')->name('post\getWithUser');

Route::get('/comment/{id}', 'CommentController@get')->name('comment\get');
Route::post('/comment', 'CommentController@post')->name('comment\post');
Route::patch('/comment/{id}', 'CommentController@patch')->name('comment\patch');
Route::delete('/comment/{id}', 'CommentController@delete')->name('comment\delete');

Route::get('/health', function (Request $request) {
    return ['MSG' => 'OK', 'STATUS' => 200];
});

Route::get('/test/join', function (Request $reqeust) {
    $data = User::join('picture', 'user.email', '=', 'picture.owner_email')
        ->where('email', 'dudu@dudu.du')->get();
    dump($data);
    // dump($data->getAttributes());
    // $data = User::find(['dudu@dudu.du'])[0]->picture();
    // dump($data);
    // $data = User::where('email','dudu@dudu.du')->picture();
    // dump($data[0]->getAttributes());
    return ['MSG' => 'OK', 'STATUS' => 200];
});
