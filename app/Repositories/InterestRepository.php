<?php

namespace App\Repositories;

use App\Models\Interest;

class InterestRepository {

    public function get(){
        return Interest::all();
    }
}