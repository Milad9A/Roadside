@extends('layouts.app', ['activePage' => 'request-management', 'titlePage' => __('Request Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('request.store') }}" autocomplete="off"
                          class="form-horizontal">
                        @csrf
                        @method('post')

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Add Request') }}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="{{ route('request.index') }}"
                                           class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label"
                                           for="customer_id">{{ __('Customer') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">

                                            <div class="col-md-10">
                                                <div class="select control">
                                                    <select name="customer_id" class="browser-default custom-select">
                                                        <option selected>Select Customer</option>
                                                        @foreach(App\User::all() as $customer)
                                                            <option
                                                                value="{{$customer->id}}">{{$customer->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('customer_id'))
                                                        <span id="name-error"
                                                              class="error text-danger"
                                                              for="customer_id">{{ $errors->first('customer_id') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label"
                                           for="company_id">{{ __('Company') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">

                                            <div class="col-md-10">
                                                <div class="select control">
                                                    <select name="company_id" class="browser-default custom-select">
                                                        <option selected>Select Company</option>
                                                        @foreach(App\Company::all() as $company)
                                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('company_id'))
                                                        <span id="name-error"
                                                              class="error text-danger"
                                                              for="company_id">{{ $errors->first('company_id') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label"
                                           for="type">{{ __('Type') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">

                                            <div class="col-md-10">
                                                <div class="select control">
                                                    <select name="type" class="browser-default custom-select">
                                                        <option selected>Select Type</option>
                                                        <option value="transport">Transport</option>
                                                        <option value="tow">Tow</option>
                                                        <option value="fuel">Fuel</option>
                                                        <option value="tire">Tire</option>
                                                        <option value="battery">Battery</option>
                                                    </select>
                                                    @if ($errors->has('type'))
                                                        <span id="name-error"
                                                              class="error text-danger"
                                                              for="type">{{ $errors->first('type') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label"
                                           for="service_id">{{ __('Service') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">

                                            <div class="col-md-10">
                                                <div class="select control">
                                                    <select name="service_id" class="browser-default custom-select">
                                                        <option selected>Select Service</option>
                                                        @foreach(App\Models\Service\Service::all()->where('is_sub', 1) as $service)
                                                            <option
                                                                value="{{$service->id}}">{{$service->name_en}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('service_id'))
                                                        <span id="name-error"
                                                              class="error text-danger"
                                                              for="service_id">{{ $errors->first('service_id') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label
                                        class="col-sm-2 col-form-label">{{ __('Status') }}</label>
                                    <div class="col-sm-7">
                                        <div
                                            class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                            <input
                                                class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}"
                                                name="status" id="input-name"
                                                type="text"
                                                placeholder="{{ __('Status') }}"
                                                value="{{ old('status') }}"
                                                required aria-required="true"/>
                                            @if ($errors->has('status'))
                                                <span id="name-error"
                                                      class="error text-danger"
                                                      for="status">{{ $errors->first('status') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label
                                        class="col-sm-2 col-form-label">{{ __('Note') }}</label>
                                    <div class="col-sm-7">
                                        <div
                                            class="form-group{{ $errors->has('note') ? ' has-danger' : '' }}">
                                            <input
                                                class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}"
                                                name="note" id="input-name"
                                                type="textfield"
                                                placeholder="{{ __('Note') }}"
                                                value="{{ old('note') }}"
                                                aria-required="true"/>
                                            @if ($errors->has('note'))
                                                <span id="name-error"
                                                      class="error text-danger"
                                                      for="note">{{ $errors->first('note') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Add Request') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
