<?php

use App\Http\Controllers\Api\Auth\CompanyAuthController;
use App\Http\Controllers\Api\Auth\CustomerAuthController;
use App\Http\Controllers\Api\OfferService\OfferSerivceController;
use App\Http\Controllers\Api\Profile\ProfileController;
use App\Http\Controllers\Api\RequestService\RequestServiceController;
use App\Http\Controllers\Api\Services\ServicesController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\UserTokens\UserTokensController;
use App\Models\RequestService\RequestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['prefix'=>'auth'],function (){
    Route::post('register/customer',[CustomerAuthController::class, 'register']);
    Route::post('register/owner',[CustomerAuthController::class, 'registerOwner']);

    Route::post('login/customer',[CustomerAuthController::class, 'login']);
    Route::post('login/owner',[CustomerAuthController::class, 'login']);
//    Route::post('register/company',[CompanyAuthController::class, 'register']);
//    Route::post('login/company',[CompanyAuthController::class, 'login']);
    Route::get('info/customer',[CustomerAuthController::class, 'getInfo']);
//    Route::get('info/company', [CompanyAuthController::class, 'getInfo']);
});
Route::group(['middleware'=>'jwt.auth'],function (){
    Route::get('services/',[ServicesController::class, 'index']);
    Route::post('user/change/status',[UserController::class, 'changeStatus']);
    Route::get('sub/services/{id}',[ServicesController::class, 'getSubServices']);
    Route::post('/offer/store',[OfferSerivceController::class, 'store']);
    
    Route::get('offer/by/{id}',[OfferSerivceController::class, 'getOfferById']);
    //
    Route::post('offer/user/approve',[OfferSerivceController::class, 'userApproveOffer']);
    Route::get('offers/by/request/{id}',[OfferSerivceController::class, 'offerByRequestId']);
});
/* Tokens Routes */
Route::group(['middleware' => 'jwt.auth', 'prefix' => 'token'], function () {
    Route::post('/set', [UserTokensController::class, 'store']);
    Route::get('/get', [UserTokensController::class, 'getTokens']);
    Route::post('/delete', [UserTokensController::class, 'delToken']);
    Route::get('/get/{user_id}', [UserTokensController::class, 'getTokenUser']);
});


Route::group(['middleware'=>'jwt.auth' , 'prefix'=>'user'],function (){
    Route::get('get/myRequest/all',[UserController::class, 'getMyRequests']);
    Route::get('get/myRequest/by/status/{status}',[UserController::class, 'getMyRequestsByStatus']);
});


Route::group(['middleware' => 'jwt.auth', 'prefix' => 'profile'], function () {
    Route::post('/update/image/',[ProfileController::class,'updateImageProfile']);
    Route::post('/update/password/',[ProfileController::class,'updatePassword']);
    Route::post('/update/phone/',[ProfileController::class,'updatePhone']);
});

Route::group(['middleware' => 'jwt.auth', 'prefix' => 'order'], function () {
    //Route::post('/new','Api\RequestService\RequestServiceController@store');
    Route::post('/assign/to/company',[RequestServiceController::class,'assignToCompany']);
    Route::post('/new', [RequestServiceController::class, 'store']);
    //Route::post('/new/',[RequestServiceController::class,'store']);
});
