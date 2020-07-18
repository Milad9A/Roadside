<?php

namespace App\Http\Controllers;

use App\Models\RequestService\RequestService;
use Illuminate\Http\Request;
use FarhanWazir\GoogleMaps\GMaps;

class RequestsController extends Controller
{
    public function index()
    {
        $request_services = RequestService::all();
        return view('requests.index', compact('request_services'));
    }

    public function edit($id)
    {

        $config = array();
        $config['center'] = '34.868627, 36.244263';
        $config['zoom'] = '22';
        $config['map_height'] = '400px';
        $gmap = new GMaps();
        $gmap->initialize($config);
        $map = $gmap->create_map();

        $request_s = RequestService::findOrFail($id);
        return view('requests.edit', compact('request_s', 'map'));
    }
}
