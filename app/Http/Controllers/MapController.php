<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use FarhanWazir\GoogleMaps\GMaps;

class MapController extends Controller
{
    public function map()
    {
        $config = array();
        $config['center'] = '34.868627, 36.244263';
        $config['zoom'] = '22';
        $config['map_height'] = '100%';

        $gmap = new GMaps();
        $gmap->initialize($config);

        $map = $gmap->create_map();
        return view('map', compact('map'));
    }
}
