<?php

namespace App\Models\RequestService;

use App\Company;
use App\Models\OfferRequest\OfferRequest;
use App\Models\TowServiceDetail\TowServiceDetails;
use App\Models\TransportServiceDetail\TransportServiceDetails;
use App\User;
use Illuminate\Database\Eloquent\Model;

class RequestService extends Model
{
    protected $fillable = [
        'customer_id',
        'company_id',
        'service_id',
        'status',
        'start_qr',
        'end_qr',
        'points',
        'type',
        'note',
        'request_lat',
        'request_long',
        'date_request',
        'time_request',

    ];

    public function towServiceDetails()
    {
        return $this->hasOne(TowServiceDetails::class, 'request_services_id', 'id');
    }
    public function transportServiceDetails()
    {
        return $this->hasOne(TransportServiceDetails::class, 'request_services_id', 'id');
    }
    public function offers()
    {
        return $this->hasMany(OfferRequest::class, 'request_service_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
