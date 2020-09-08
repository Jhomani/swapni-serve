<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use Auth;

class ChatController extends Controller
{
  public function fetchMessage() {
    return Message::with('user')->get();
  }

  public function sendMessage(Request $request) {
    return $user;

    $message = User::find(1)->messages()->create([
      'message'=> $request->message
    ]);

    broadcast(new NewMessage( $message->load('user')))-toOthers();
    
    return 'ok';
  }
}
