<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class RegistrationException extends Exception{

  public function __construct($message = "There is some error!", $code = 400, Throwable $previous = null)
  {
    parent::__construct($message, $code, $previous);
  }

}