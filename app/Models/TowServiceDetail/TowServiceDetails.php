<?php

namespace App\Models\TowServiceDetail;

use Illuminate\Database\Eloquent\Model;

class TowServiceDetails extends Model
{
    protected $fillable = [
        'load_city',
        'load_address',
        'load_address_lat',
        'load_address_long',
        'down_city',
        'down_address',
        'down_address_lat',
        'down_address_long',
        'request_services_id'
    ];
}
