<?php

namespace App\Http\Controllers;

use App\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('company.index', compact('companies'));
    }

    public function create()
    {
        return view('company.create');
    }

    public function store()
    {
        $company = new Company(request()->validate([
            'name' => 'required',
        ]));
        $company->save();
        return redirect(route('company.index'));
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('company.edit', compact('company'));
    }

    public function update($id)
    {
        $company = Company::findOrFail($id);
        $company->update(request()->validate([
            'name' => 'required',
        ]));
        return redirect()->back();
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->route('company.index')->withStatus(__('Company successfully deleted.'));
    }
}
