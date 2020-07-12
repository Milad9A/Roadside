<?php

namespace App\Http\Controllers\Api\Services;

use App\Http\Controllers\JWTController;
use App\Models\Service\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServicesController extends JWTController
{
    public function index()
    {
        try {
            return response()->json(['status' => true, 'data' => Service::query()->whereNull('service_id')->get()], 200);
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'Messages' => $ex->getMessage()], 500);
        }
    }

    public function getSubServices($id)
    {
        try {
            return response()->json(['status' => true, 'data' => Service::query()->where('service_id',$id)->get()], 200);
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'Messages' => $ex->getMessage()], 500);
        }
    }
}
