<?php

namespace App\Exceptions;

use Exception,
    Throwable;

class AuthenticationException extends Exception{

  public function __construct($message = "", $code = 401, Throwable $previous = null)
  {
    parent::__construct($message, $code, $previous);
  }

}