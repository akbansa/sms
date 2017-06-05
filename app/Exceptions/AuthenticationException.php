<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class AuthenticationException extends Exception{

  public function __construct($message = "Your email or password is incorrect!", $code = 401, Throwable $previous = null)
  {
    parent::__construct($message, $code, $previous);
  }

}