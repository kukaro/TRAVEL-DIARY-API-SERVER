<?php

use App\Model\Post;
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
Route::post('/signup', 'JWTAuthController@signup')->name('api.jwt.signup');
Route::middleware('auth:api')->get('/user', 'JWTAuthController@user')->name('api.jwt.user');
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('user', 'JWTAuthController@user')->name('api.jwt.user');
});

Route::get('/user/{email}', 'UserController@get')->name('user\get');
Route::post('/user', 'UserController@post')->name('user\post');
Route::patch('/user/{email}', 'UserController@patch')->name('user\patch');
Route::delete('/user/{email}', 'UserController@delete')->name('user\delete');

Route::get('/picture/user/{id}', 'PictureController@getWithUser')->name('picture\getWithUser');
Route::get('/picture/{id}', 'PictureController@get')->name('picture\get');
Route::post('/picture', 'PictureController@post')->name('picture\post');
Route::patch('/picture/{id}', 'PictureController@patch')->name('picture\patch');
Route::delete('/picture/{id}', 'PictureController@delete')->name('picture\delete');

Route::get('/post-picture/{id}', 'PostPictureController@get')->name('post\get');
Route::post('/post-picture', 'PostPictureController@post')->name('post\post');

Route::middleware('auth:api', 'can:general,'.User::class)->get('/post/user', 'PostController@getWithUser')->name('post\getWithUser');
Route::middleware('auth:api')->get('/post/{id}', 'PostController@get')->name('post\get');
Route::middleware('auth:api')->post('/post', 'PostController@post')->name('post\post');
Route::middleware('auth:api')->patch('/post/{id}', 'PostController@patch')->name('post\patch');
Route::middleware('auth:api')->delete('/post/{id}', 'PostController@delete')->name('post\delete');
Route::get('/post/picture/{id}', 'PostController@getWithPicture')->name('post\getWithPicture');

Route::get('/comment/{id}', 'CommentController@get')->name('comment\get');
Route::post('/comment', 'CommentController@post')->name('comment\post');
Route::patch('/comment/{id}', 'CommentController@patch')->name('comment\patch');
Route::delete('/comment/{id}', 'CommentController@delete')->name('comment\delete');

Route::get('/health', function (Request $request) {
    return ['MSG' => 'OK', 'STATUS' => 200];
});

Route::get('/test/join', function (Request $request) {
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

Route::get('/file/{catchall}', 'FileController@get')->where('catchall', '.*')->name('file\get');
Route::post('/file', 'FileController@post')->name('file\post');
Route::delete('/file/{catchall}', 'FileController@delete')->where('catchall', '.*')->name('file\delete');

Route::get('/hiworks/callback','HiworksController@callback')->name('hiworks\callback');
Route::get('/hiworks','HiworksController@get')->name('hiworks\get');
