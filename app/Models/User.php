<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Notifications\Notifiable;

class User extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    use Notifiable;

    protected $primaryKey = 'user_id';

    protected $fillable = ['user_id', 'name', 'email', 'password'];
    protected $hidden = ['password'];
}
