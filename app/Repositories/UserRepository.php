<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository{

  public function register($data) {

    return User::create($data);
  }

  public function reset($input){
    User::where('email',$input['email'])
        ->update(['password'=>Hash::make($input['password'])]);
  }

}