<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bikeman extends Model
{

    protected $fillable = [
        "name","region_id", "phone_number", "phone_number", "status", "home_address"
    ];

    public function user (){
        return $this->belongsTo(User::class);
    }

}
