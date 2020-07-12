<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\JWTController;
use App\Models\RequestService\RequestService;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends JWTController
{
    public function changeStatus(Request $request)
    {
        $validator = Validator::make($request->all(),['status'=>'required|string']);
        if ($validator->fails()) {
            return response(['status'=>true,'Message'=>$validator->getMessageBag()],400);
        }
        try {
            $user = $this->getAuthenticatedUser();
            $user->status =$request->status;
            $user->save();
            return response(['status'=>true,'user'=>$user],200);
        }
        catch (\Exception $ex) {
            return response(['status'=>true,'Message'=>$ex->getMessage()],500);
        }
    }
    public function getMyRequests()
    {

        try {
            $user = $this->getAuthenticatedUser();
            $data = RequestService::query()->where('customer_id',$user->id)->get();
            return response(['status'=>true,'data'=>$data->load('towServiceDetails','transportServiceDetails')],200);
        }
        catch (\Exception $ex) {
            return response(['status'=>true,'Message'=>$ex->getMessage()],500);
        }
    }
    public function getMyRequestsByStatus($status)
    {

        try {
            $user = $this->getAuthenticatedUser();
            $data = RequestService::query()->where('customer_id',$user->id)->where('status',$status)->get();
            return response(['status'=>true,'data'=>$data->load('towServiceDetails','transportServiceDetails')],200);
        }
        catch (\Exception $ex) {
            return response(['status'=>true,'Message'=>$ex->getMessage()],500);
        }
    }
}
