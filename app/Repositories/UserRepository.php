<?php

namespace App\Repositories;

use Hash,
    App\Models\User;

class UserRepository{
  /**
   * create user
   *
   * @param $data
   * @return mixed
   */
  public function register($data) {

    return User::create($data);

  }

  /**
   * find user by email
   *
   * @param $user
   * @return mixed
   */
  public function findFromEmail($email) {

    return User::where('email', $email);
  }

  /**
   * update user password
   *
   * @param $input
   */
  public function update($user, $password){

    $user->update(['password'=> Hash::make($password)]);

  }

}