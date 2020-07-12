<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\JWTController;
use App\Models\CustomerUser\CustomerUser;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;


class CustomerAuthController extends JWTController
{

    public function register(Request $request)
    {
        $rules = [
            'phone' => 'required|unique:users',
            'name' => 'required',
            'password' => 'required|min:6'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'Messages' => $validator->getMessageBag()], 400);
        }
        try {
            $customer = User::query()->create(['name'=>$request->name,'phone' => $request->phone, 'password' => Hash::make($request->password)]);
            $token = JWTAuth::getFacadeRoot()->fromUser($customer);
            return response()->json(['status' => true, 'token' => $token], 200);
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'Messages' => $ex->getMessage()], 500);

        }
    }
    public function registerOwner(Request $request)
    {
        $rules = [
            'phone' => 'required|unique:users',
            'name' => 'required',
            'password' => 'required|min:6',
            'type' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'Messages' => $validator->getMessageBag()], 400);
        }
        try {
            $customer = User::query()->create(['name'=>$request->name,'type'=>$request->type,'phone' => $request->phone, 'password' => Hash::make($request->password)]);
            $token = JWTAuth::getFacadeRoot()->fromUser($customer);
            return response()->json(['status' => true, 'token' => $token], 200);
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'Messages' => $ex->getMessage()], 500);

        }
    }

    public function login(Request $request)
    {
        $rules = [
            'phone' => 'required',
            'password' => 'required|min:6'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'Messages' => $validator->getMessageBag()], 400);
        }
        try {

            if ($token = JWTAuth::getFacadeRoot()->attempt(['phone' => $request->phone, 'password' => $request->password])) {
                return response()->json(['status' => true, 'token' => $token], 200);
            } else {
                return response()->json(['status' => false, 'Messages' => 'Invalid Data '], 401);
            }
        } catch (\JWTException $ex) {
            return response()->json(['status' => false, 'Messages' => $ex->getMessage()], 500);
        }
    }
    public function getInfo()
    {
        return $this->getAuthenticatedUser();
    }
}
