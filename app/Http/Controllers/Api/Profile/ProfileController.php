<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\JWTController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends JWTController {

    public function updateImageProfile(Request $request)
{
    $rules = [
        'image' => 'required',
    ];

    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        return response()->json(['status' => false, 'Messages' => $validator->getMessageBag()], 400);
    }
    try {
        if ($request->hasFile('image')) {
            $user = $this->getAuthenticatedUser();
//                unlink(public_path() . $user->image);
            $path = '/images/users/' . time() . $user->id . $request->file('image')->getClientOriginalName();
            $user->image = $path;
            $user->save();
            $request->file('image')->move('images/users/', $path);
            return response()->json(['status' => true, 'data' => $user], 200);
        } else {
            return response()->json(['status' => false, 'Message' => "User Not Found"], 404);
        }
    } catch (\Exception $ex) {
        return response()->json(['status' => false, 'Messages' => $ex->getMessage()], 500);
    }
}

    public function updatePassword(Request $request)
{
    $rules = [
        'old_password' => 'required|min:6',
        'new_password' => 'required|min:6',
    ];

    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        return response()->json(['status' => false, 'Messages' => $validator->getMessageBag()], 400);
    }
    try {
        $user = $this->getAuthenticatedUser();
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return response()->json(['status' => true, 'Messages' => 'Password Updated Successfully'], 200);

        }
        return response()->json(['status' => false, 'Messages' => 'User Not Found '], 404);

    } catch (\Exception $ex) {
        return response()->json(['status' => false, 'Messages' => $ex->getMessage()], 500);
    }
}

    public function updatePhone(Request $request)
{
    $rules = [
        'phone' => 'required|unique:users',
    ];
    $user = $this->getAuthenticatedUser();
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        return response()->json(['status' => false, 'Messages' => $validator->getMessageBag()], 400);
    }
    try {
        $user->phone = $request->phone;
        $user->save();

        return response()->json(['status' => true, 'data' => $user], 200);

    } catch (\Exception $ex) {
        return response()->json(['status' => false, 'Messages' => $ex->getMessage()], 500);
    }
}
}
