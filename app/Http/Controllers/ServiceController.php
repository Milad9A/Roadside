<?php

namespace App\Http\Controllers;

use App\Models\Service\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
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
        return view('services.edit',compact('service'));
    }

    public function update($id)
    {
        $service = Service::findOrFail($id);
        $service->update(request()->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
        ]));
        return redirect(route('service.index'));
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('service.index')->withStatus(__('Service successfully deleted.'));
    }
}
