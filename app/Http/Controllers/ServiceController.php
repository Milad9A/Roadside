<?php

namespace App\Http\Controllers;

use App\Models\Service\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_sub', 0)->where('service_id', NULL)->get();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store()
    {
        $service = new Service(request()->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
        ]));
        $service->save();
        return redirect(route('service.index'));
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->update(request()->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'photo_selected' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]));

        if ($image = $request->file('photo')) {
            $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $filepath = $request->file('photo')->storeAs('services', $imageName, 'public_images');
            $service->update([
                'photo' => '/images/' . $filepath,
            ]);
        }
        if ($image = $request->file('photo_selected')) {
            $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $filepath = $request->file('photo_selected')->storeAs('services', $imageName, 'public_images');
            $service->update([
                'photo_selected' => '/images/' . $filepath,
            ]);
        }
        return redirect(route('service.index'));
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('service.index')->withStatus(__('Service successfully deleted.'));
    }
}
