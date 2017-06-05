<?php

namespace App\Exceptions;

use Exception,
    Throwable;

class StudentException extends Exception {

  public function __construct($message = "", $code = 0, Throwable $previous = null)
  {
    parent::__construct($message, $code, $previous);
  }
}