<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        "name", "description"
    ];

    public function regions(){
        $this->hasMany(Region::class);
    }
}
