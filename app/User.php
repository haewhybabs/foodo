<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

      'email', 'password', "role_id",

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        $this ->hasOne(Role::class);
    }

    public function vendor(){
        $this-> hasOne(Vendor::class);
    }

    public function customer(){
        $this-> hasOne(Customer::class);
    }

    public static function checkAccount($email){
        $check_account = User::where('email',$email)->first();
        if ($check_account) {
            return true;
        }
        else {
            return false;
        }
    }
}
