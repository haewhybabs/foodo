<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $fillable = [
        "name", "address","phone_number", "user_id",
    ];

    public function user (){
        return $this->belongsTo(User::class);
    }

}
