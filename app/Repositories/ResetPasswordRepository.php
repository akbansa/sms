<?php

namespace App\Repositories;

use Hash,
    App\Models\PasswordReset;

class ResetPasswordRepository
{
  public function forgotPassword($email) {

    $password_reset = PasswordReset::where('email', $email)->first();

    if (!$password_reset) {

      $password_reset = new PasswordReset();

      $password_reset->email = $email;

    }

    $password_reset->token = generateRandomString(10);

    $password_reset->save();

    return $password_reset->token;

  }

  public function reset($input){

    PasswordReset::where('email', $input['email'])
        ->delete();

  }

}