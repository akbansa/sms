<?php

namespace App\Models;

use Eloquent;

class Interest extends Eloquent {

    public $timestamps = false;

    public function get(){
    return $this->all();
  }
}
