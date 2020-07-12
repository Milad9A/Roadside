<?php

namespace App\Http\Controllers\Api\OfferService;

use App\Models\OfferRequest\OfferRequest;
use App\Models\RequestService\RequestService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OfferSerivceController extends Controller
{
    public function store(Request $request)
    {
        $code = 200;
        $rules = [
            'title'=>'required',
            'content'=>'required',
            'price'=>'required',
            'service_id'=>'required',
            'request_service_id'=>'required',
            'owner_request_id'=>'required',
            'company_id'=>'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $code =400;
            return response()->json(['status' => false, 'Messages' => $validator->getMessageBag()], $code);
        }
        try {
            $data = $request->only(
                'title',
                'content',
                'status',
                'price',
                'service_id',
                'request_service_id',
                'owner_request_id',
                'company_id'
            );
            $offer = OfferRequest::query()->create($data);
            return response()->json(['status' => true, 'data' =>$offer], 200);
        } catch (\Exception $ex) {
            $code = 500;
            return response()->json(['status' => false, 'Messages' => $ex->getMessage()], $code);

        }
    }

    public function getOfferById($id)
    {
        try {
            $offer = OfferRequest::query()->find($id);
            if (is_null($offer)) {
                return response()->json(['status' => false, 'Messages' =>'Offer Not Found'], 404);
            }
            return response()->json(['status' => true, 'data' =>$offer], 200);
        } catch (\Exception $ex) {
            $code = 500;
            return response()->json(['status' => false, 'Messages' => $ex->getMessage()], $code);

        }
    }

    public function offerByRequestId($id)
    {
        try {
            $rq = RequestService::query()->find($id);
            if (is_null($rq)) {
                return response()->json(['status' => false, 'Messages' =>'Offer Not Found'], 404);
            }
            return response()->json(['status' => true, 'data' =>$rq->load('offers')], 200);
        } catch (\Exception $ex) {
            $code = 500;
            return response()->json(['status' => false, 'Messages' => $ex->getMessage()], $code);

        }
    }

    public function userApproveOffer(Request $request)
    {
        $code = 200;
        $rules = [
            'offer_id'=>'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $code =400;
            return response()->json(['status' => false, 'Messages' => $validator->getMessageBag()], $code);
        }
        try {

            $offer = OfferRequest::query()->find($request->offer_id);
            if (is_null($offer)) {
                return response()->json(['status' => false, 'Messages' =>'Offer Not Found'], 404);
            }
            $offer->status = 'approve';
            $offer->save();
            return response()->json(['status' => true, 'data' =>$offer], 200);
        } catch (\Exception $ex) {
            $code = 500;
            return response()->json(['status' => false, 'Messages' => $ex->getMessage()], $code);

        }
    }
}
