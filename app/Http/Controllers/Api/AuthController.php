<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Auth;

class AuthController extends Controller
{
  public function register(Request $request) {
    $this->validate($request, [
      'name' => 'required|unique:users',
      'email' => 'required|email|unique:users',
      'password' => 'required|min:8'
    ]);

    

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password)
    ]);

    $accessToken = $user->createToken('authToken')->accessToken;

    return response()->json([
      'msg' => 'Successfully created user!',
      'access_token' => $accessToken,
      'name' => $user->name
    ]);
  }

  public function login(Request $request){
    $this->validate($request, [
      'name' => 'nullable',
      'email' => 'nullable|email',
      'password' => 'required|min:8'
    ]);

    if(Auth::attempt(request(['email', 'password'])) || Auth::attempt(request(['name', 'password']))) {
     $resultToken = $request->user()->createToken('Personal Access Token');
     
     return response()->json([
       'access_token' => $resultToken->accessToken,
       'token_type' => 'Bearer',
       'expires_at' => Carbon::parse($resultToken->token->expires_at)->toDateTimeString(),
       'name' => $request->user()->name
     ]);
    }

    return response()->json(['msg' => 'you verify the datas'], 401);
  }
}