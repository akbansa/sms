<?php

namespace App\Models;

use Eloquent;
use Illuminate\Foundation\Auth\User as Authenticable;



class User extends Authenticable
{
  protected $fillable = ['name','email','password'];

  public function students(){
    return $this->hasMany(Student::class);
  }
}