<?php

namespace App\Exceptions;

use Illuminate\Validation\ValidationException as Exception;

class ValidationException extends Exception
{
  protected $inputs;

  /**
   * Initializing $errors
   *
   * @param \Illuminate\Contracts\Validation\Validator $validator
   * @param null|\Symfony\Component\HttpFoundation\Response $inputs
   */
  function __construct($validator, $inputs)
  {
    parent::__construct($validator);

    $this->inputs = $inputs;
  }

  /**
   * Return Errors Received After Validations
   *
   * @return array
   */
  public function errors()
  {
    return $this->validator->errors()->jsonSerialize();
  }

  /**
   * Return input array on which validation is fired.
   *
   * @return array
   */
  public function inputs()
  {
    return $this->inputs;
  }
}