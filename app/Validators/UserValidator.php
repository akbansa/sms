<?php

namespace App\Validators;


class UserValidator extends Validator
{
  /**
   * validation rules
   *
   * @param $type
   * @param $data
   * @return array
   */
  protected function rules($type, $data)
  {
    $rules =  [];

    switch($type)
    {
      case 'register':

        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|custom_email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required'
        ];
        break;

      case 'reset':

        $rules = [
            'email' => 'bail|required|custom_email|exists:password_resets,email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required'
        ];
        break;

      case 'forgot':
        $rules = [
            'forgotEmail' =>  'required|custom_email|exists:users,email'
        ];
        break;

      case 'login':
        $rules = [
            'loginEmail' => 'bail|required|custom_email|exists:users,email',
            'loginPassword' => 'required_with:loginEmail|min:8'
        ];
        break;
    }
    return $rules;
  }


  /**
   * Get the attributes name.
   *
   * @param $type
   * @return array
   */
  protected function getAttributeNamesForHuman($type)
  {
    $attributes =  [];

    switch($type)
    {
      case 'verify':
        $attributes = [
            'verify_hash' => 'hash',
        ];
        break;
      case 'reset-password':
        $attributes = [
            'api_token' =>  'token'
        ];
        break;

    }
    return $attributes;
  }


  /**
   * Custom validation messages
   *
   * @param $type
   * @return array
   */
  protected function messages($type)
  {
    switch($type)
    {

      case 'register':
        return [
            'unique'  =>  'Account already exist!'
        ];
        break;

      case 'reset':
        return [
            'exists'  =>  'You cannot reset password for this email!',
            'token.exists' =>  'Your token is invalid. Please get a new password again!'
        ];
        break;

      case 'login':
        return [
            'exists'  =>  'The account doesn\'t exist!'
        ];
        break;

      case 'forgot':
        return [
            'exists'  =>  'The account doesn\'t exist!'
        ];
        break;

      default:
        return [];
    }
  }

}