<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{

    protected $guarded = [];


    public function flavors() {
        return $this->belongsToMany('App\Flavor');
    }

    public function path() {
        return '/recipes/' . $this->id;
        
    }
    
    public function addFlavor($flavor, $flavor_perc)
    {
        $flavor_id = $flavor->id;

        return $this->flavors()->attach($flavor, $flavor_perc);

        // return $this->flavors()->attach([
        //     'flavor' => $flavor_id,
        //     'flavor_perc'   =>  request('flavor_perc')
        // ]);

    }

 
 
}
