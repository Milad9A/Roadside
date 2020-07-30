<?php

namespace App\Http\Controllers;

use App\Models\OfferRequest\OfferRequest;
use Illuminate\Http\Request;

class OffersController extends Controller
{
    public function index()
    {
        $offers = OfferRequest::latest();

        if(request()->has('request_s')){
            $offers->where('request_service_id', request('request_s'));
        }

        $offers = $offers->get();
        return view('offers.index', compact('offers'));
    }


    public function destroy($id)
    {
        $offer = OfferRequest::findOrFail($id);
        $offer->delete();

        return redirect()->route('offer.index')->withStatus(__('Offer successfully deleted.'));
    }
}
