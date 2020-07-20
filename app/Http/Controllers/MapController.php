<?php

namespace App\Http\Controllers;

use App\Models\RequestService\RequestService;
use Illuminate\Http\Request;
use FarhanWazir\GoogleMaps\GMaps;

class MapController extends Controller
{
    public function map($id)
    {
        $request_s = RequestService::findOrFail($id);

        $config = array();
        $config['center'] = $request_s->request_lat . ', ' . $request_s->request_long;
        $config['zoom'] = '22';
        $config['map_height'] = '100%';

        $gmap = new GMaps();
        $gmap->initialize($config);

        $marker['position'] = $request_s->request_lat . ', ' . $request_s->request_long;
        $marker['infowindow_content'] = $request_s->request_lat . ', ' . $request_s->request_long;

        $gmap->add_marker($marker);
        $map = $gmap->create_map();
        return view('map', compact('map'));
    }
}
