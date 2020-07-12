<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'type',
        'photo',
        'photo_selected',
        'service_id',
        'is_sub'
    ];
}
