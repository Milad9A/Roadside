<?php

namespace App\Http\Controllers\Api\RequestService;

use App\Http\Controllers\JWTController;
use App\Models\RequestService\RequestService;
use App\Models\TowServiceDetail\TowServiceDetails;
use App\Models\TransportServiceDetail\TransportServiceDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RequestServiceController extends JWTController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //dd(5);
        $code = 200;
        $rules = [
            'customer_id'=>'required',
            'service_id'=>'required',
            'type'=>'required',
            'request_lat'=>'required',
            'request_long'=>'required',
            // 'date_request'=>'required',
            // 'time_request'=>'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $code =400;
            return response()->json(['status' => false, 'Messages' => $validator->getMessageBag()], 400);
        }
        try {
           $data = $request->only(
               'customer_id', 'service_id','type','note','request_lat',
                'request_long',
               'date_request',
               'time_request'
           );
            $res = RequestService::query()->create($data);
            $rq = RequestService::query()->find($res->id);
            if ($request->type == 'transport') {
                $details = $request->only(
                    'load_city',
                    'load_address',
                    'load_address_lat',
                    'load_address_long',
                    'down_city',
                    'down_address',
                    'down_address_lat',
                    'down_address_long'
                );
                $details['request_services_id']=$rq->id;
                TransportServiceDetails::query()->create($details);
            }

            if ($request->type == 'tow') {
                $details = $request->only(
                    'load_city',
                    'load_address',
                    'load_address_lat',
                    'load_address_long',
                    'down_city',
                    'down_address',
                    'down_address_lat',
                    'down_address_long'
                );
                $details['request_services_id']=$rq->id;
                TowServiceDetails::query()->create($details);
            }
            if($request->type == 'transport'){
                 return response()->json(['status' => true, 'data' =>$rq->load('towServiceDetails','transportServiceDetails')], 200);
            }
            else{
                 return response()->json(['status' => true, 'data' =>$rq->load('towServiceDetails')], 200);
            }
           
        } catch (\Exception $ex) {
            $code = 500;
            return response()->json(['status' => false, 'Messages' => $ex->getMessage()], 500);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function assignToCompany(Request $request)
    {
        $code = 200;
        $rules = [
            'company_id'=>'required',
            'request_service_id'=>'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $code =400;
            return response()->json(['status' => false, 'Messages' => $validator->getMessageBag()], 400);
        }
        try {
             RequestService::query()->find($request->request_service_id)->update(['company_id'=>$request->company_id]);
            $data=  RequestService::query()->find($request->request_service_id);
            return response()->json(['status' => true, 'data' =>$data], 200);
        } catch (\Exception $ex) {
            $code = 500;
            return response()->json(['status' => false, 'Messages' => $ex->getMessage()], 500);

        }
    }
}
