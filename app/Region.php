<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = [
        "name", "description", "city_id"
    ];

    public function cities(){
        return $this ->belongsTo(City::class);
    }

    public function vendors(){
        return $this ->hasMany(Vendor::class);
    }
}
