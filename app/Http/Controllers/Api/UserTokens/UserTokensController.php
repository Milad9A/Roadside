<?php

namespace App\Http\Controllers\Api\UserTokens;

use App\Http\Controllers\JWTController;
use App\Models\UserToken\UserToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserTokensController extends JWTController
{
    public function store(Request $request)
    {

        $rules =[
            'token'=>'required',
        ];
        $data = $request->only('token');
        $validator = Validator::make($data, $rules);
        if ($validator->fails()){
            return response()->json(['status'=>false,'Messages' =>$validator->getMessageBag()],400);
        }
        try {
            $user = $this->getAuthenticatedUser();
            $data['user_id']= $user->id;
            $res = UserToken::query()->create($data);
            return response()->json(['status'=>true,'data'=>$res],201);
        }
        catch (\Exception $ex) {
            return response()->json(['status'=>false,'Messages' =>$ex->getMessage()],500);
        }
    }
    public function getTokens()
    {
        try {
            $user = $this->getAuthenticatedUser();
            $tokens = UserToken::query()->where('user_id',$user->id)->pluck('token');
            return response()->json(['status'=>true,'tokens'=>$tokens],200);
        }
        catch (\Exception $ex) {
            return response()->json(['status'=>false,'Messages' =>$ex->getMessage()],500);
        }
    }
    public function getTokenUser()
    {
        try {
            $user = $this->getAuthenticatedUser();
            $tokens = UserToken::query()->where('user_id',request('user_id'))->pluck('token');
            return response()->json(['status'=>true,'tokens'=>$tokens],200);
        }
        catch (\Exception $ex) {
            return response()->json(['status'=>false,'Messages' =>$ex->getMessage()],500);
        }
    }

    public function delToken(Request $request)
    {
        try {
            
            $user = $this->getAuthenticatedUser();
            $user_token = UserToken::where('user_id',$user->id)->where('token',$request->token)->first();
            //dd($user);
            $status =  $user_token->delete();
            
            if ($status) {
                return response()->json(['status'=>true,'Messages'=>'Token Was Deleted'],200);
            } else {
                return response()->json(['status'=>false,'Messages'=>'Token Not Found '],400);
            }
        }
        catch (\Exception $ex) {
            return response()->json(['status'=>false,'Messages' =>$ex->getMessage()],500);
        }
    }
}
