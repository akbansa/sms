<?php

namespace App\Models;

use Eloquent;

class PasswordReset extends Eloquent{

  protected $fillable = ['email','token'];
  
}