<?php

namespace App\Repositories;

use App\Models\Interest;

class InterestRepository {

  /**
   * get all interests
   * @return mixed
   */
    public function get(){
        return Interest::all();
    }
}