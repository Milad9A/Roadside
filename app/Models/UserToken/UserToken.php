<?php

namespace App\Models\UserToken;

use Illuminate\Database\Eloquent\Model;

class UserToken extends Model
{
    protected $fillable = ['token','user_id'];

}
