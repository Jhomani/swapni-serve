<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Events\NewMessage;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');

Route::group(['middlewate' => 'auth:api'], function() {
  Route::get('/fetch-messages', 'ChatController@fetchMessage');
  Route::post('/send-message', 'ChatController@sendMessage');
});

Route::get('/test', function () {
  return 'this work it';
});

Route::get('/', function () {
    broadcast(new NewMessage('erres el mejor de los mejores'));
});
