<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\NewMessage;
use App\Message;
use App\User;
use Auth;

class ChatController extends Controller
{
  public function fetchMessage(Request $request) {
    $message = Message::with('user')->get();

    return response()->json([
      'message' => $message,
    ]); 
  }

  public function fetchUsers(Request $request) {
    $users= User::select()->get();

    return response()->json([
      'message' => $users,
    ]); 
  }

  public function sendMessage(Request $request) {
    $message = User::where('name', $request->user)->first()->messages()->create([
      'message'=> $request['message']
    ]);

    broadcast(new NewMessage($message->load('user')))->toOthers();
    
    return 'ok';
  }


}
