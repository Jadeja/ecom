<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    protected $guard = 'Admin';
    protected $fillable = ['name','email','password','type','image','status','mobile','created_at','updated_at'];
    protected $hidden = ['password','remember_token'];
}
