<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service\Service;

class SubServiceController extends Controller
{
    public function store($id)
    {
        $sub = new Service(request()->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
        ]));
        $sub->service_id = $id;
        $sub->is_sub = 1;
        $sub->save();
        return redirect()->back();
    }

    public function edit($id)
    {
        $sub = Service::findOrFail($id);
        return view('services.sub_services.edit', compact('sub'));
    }

    public function update(Request $request, $id)
    {
        $sub = Service::findOrFail($id);
        $sub->update(request()->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
        ]));
        return redirect()->back();
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->back()->withStatus(__('Sub service successfully deleted.'));
    }
}
