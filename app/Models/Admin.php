<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guard= 'admin';
    protected $fillable=['name','email','password','image','status','phone','type'];
    protected $hidden =['password','access_token'];

    function isAdmin(){
        return $this->type == 'admin';
    }
}
