<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Message extends Model
{
  protected $fillable = ['message'];

  public function user() {
    return belongTo(User::class);
  }
}
