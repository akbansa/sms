<?php

namespace App\Validators;


class StudentValidator extends Validator
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
      case 'create':

        $rules = [
            'name' => 'required|min:3|string',
            'address' => 'required',
            'year' => 'required',
            'gender' => 'required|integer',
            'interests' => 'array'
        ];
        break;

      case 'update':

        $rules = [
            'name' => 'required|min:3|string',
            'address' => 'required',
            'year' => 'required',
            'gender' => 'required|integer',
            'interests' => 'array'
        ];
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
      default:
        return [];
    }
  }

}