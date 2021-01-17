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

use App\Notifications\EmailNotification;
use App\User;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/email', function () {
  User::find(4)->notify(new EmailNotification);
  
  // $users = User::find(4);

  // Notification::send($users, new EmailNotification());
});

Route::get('/send-email', function () {
  User::find(4)->notify(new EmailNotification);

  $details = [
    'title' => 'Mail from this page'
  ];

  \Mail::to('junkedev@gmail.com')->send(new \App\Mail\TestMail($details));

  echo 'all will be good!';
});