<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{

    protected $fillable = [
        "manager_name", "store_name", "address", "logo", "phone_number", "status",
        "description", "user_id","category_id", "region_id", "open_at", "close_at"
    ];

    public function user (){
        return $this->belongsTo(User::class);
    }

    public function category (){
        return $this->belongsTo(Category::class);
    }

    public function region (){
        return $this->belongsTo(Region::class);
    }

}
