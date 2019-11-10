<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flavor extends Model
{
    //

    public function recipes() {
        return $this->belongsToMany('App\Recipe');
    }


        
}
