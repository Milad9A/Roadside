<?php

namespace App\Models\OfferRequest;

use App\Models\RequestService\RequestService;
use App\Models\Service\Service;
use App\User;
use Illuminate\Database\Eloquent\Model;

class OfferRequest extends Model
{
    protected $fillable =
        [
            'title',
            'content',
            'status',
            'price',
            'service_id',
            'request_service_id',
            'owner_request_id',
            'company_id',
        ];

    public function company()
    {
        return $this->belongsTo(User::class,'company_id','id');
    }

    public function owner_request()
    {
        return $this->belongsTo(User::class,'owner_request_id','id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class,'service_id','id');
    }

    public function request()
    {
        return $this->belongsTo(RequestService::class,'request_service_id','id');
    }

}
