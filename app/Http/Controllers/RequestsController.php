<?php

namespace App\Http\Controllers;

use App\Models\RequestService\RequestService;
use Illuminate\Validation\Rule;

class RequestsController extends Controller
{
    public function index()
    {
        $request_services = RequestService::all();
        return view('requests.index', compact('request_services'));
    }

    public function create()
    {
        return view('requests.create');
    }

    public function store()
    {
        $request_s = new RequestService(request()->validate([
            'customer_id' => 'required|exists:users,id',
            'company_id' => 'required|exists:companies,id',
            'service_id' => 'required|exists:services,id',
            'type' => ['required', Rule::in(['transport', 'tow', 'fuel', 'tire', 'battery'])],
            'status' => 'nullable',
            'note' => 'nullable',
        ]));
        $request_s->save();
        return redirect(route('request.index'));
    }

    public function edit($id)
    {
        $request_s = RequestService::findOrFail($id);
        $types = collect(['transport' => 'transport', 'tow' => 'tow', 'fuel' => 'fuel', 'tire' => 'tire', 'battery' => 'battery']);
        $types = $types->except($request_s->type);
        return view('requests.edit', compact('request_s', 'types'));
    }

    public function update($id)
    {
        $request_s = RequestService::findOrFail($id);
        $request_s->update(request()->validate([
            'customer_id' => 'required|exists:users,id',
            'company_id' => 'required|exists:companies,id',
            'service_id' => 'required|exists:services,id',
            'type' => ['required', Rule::in(['transport', 'tow', 'fuel', 'tire', 'battery'])],
            'status' => 'nullable',
            'note' => 'nullable',
        ]));

        return redirect()->back();
    }


    public function destroy($id)
    {
        $request_s = RequestService::findOrFail($id);
        $request_s->delete();

        return redirect()->route('request.index')->withStatus(__('Request successfully deleted.'));
    }
}
