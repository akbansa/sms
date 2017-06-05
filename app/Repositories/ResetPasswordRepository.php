<?php

namespace App\Repositories;

use Hash,
    App\Models\PasswordReset;

class ResetPasswordRepository
{

  /**
   * find user by email
   *
   * @param $email
   * @return mixed
   */
  public function findFromEmail($email) {
    return PasswordReset::where('email', $email)->first();
  }

  /**
   * generate password reset token
   *
   * @param $email
   * @return bool|string
   */
  public function generateToken($email) {

    $password_reset = PasswordReset::where('email', $email)->first();

    if (!$password_reset) {

      $password_reset = new PasswordReset();

      $password_reset->email = $email;

    }

    $password_reset->token = generateRandomString(10);

    $password_reset->save();

    return $password_reset->token;

  }

  /**
   * delete password reset entry
   *
   * @param $input
   */
  public function delete($input){

    PasswordReset::where('email', $input['email'])
        ->delete();

  }

}