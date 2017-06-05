<?php

namespace App\Models;

use Eloquent;

class Student extends Eloquent
{
    protected $fillable = ['name','address','gender','year','user_id'];

    public function interests() {
        return $this->belongsToMany(Interest::class);
    }

    public function user(){
      return  $this->belongsTo(User::class);
    }
}
