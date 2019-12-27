<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table='vendors';

    protected $fillable = [
        'manager_name', 'store_name', 'address','logo','phone_number','status','description','user_id','category_id','region_id','open_at','close_at',
    ];
}
