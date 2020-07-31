@extends('layouts.app', ['activePage' => 'request-management', 'titlePage' => __('Request Management')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ route('request.update', $request_s) }}" autocomplete="off"
                    class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    @method('put')


                    @if (session('status'))
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                                <span>{{ session('status') }}</span>
                            </div>
                        </div>
                    </div>
                    @endif


                    @if (count($errors) > 0)

                    <div class="alert alert-danger">

                        <strong>Whoops!</strong> There were some problems with your input.

                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                    @endif

                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('Edit Request') }}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a href="{{ route('request.index') }}"
                                        class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                </div>
                            </div>


                            <div class="row">
                                <label class="col-sm-2 col-form-label" for="customer_id">{{ __('Customer') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group">

                                        <div class="col-md-10">
                                            <div class="select control">
                                                <select name="customer_id" class="browser-default custom-select">
                                                    <option selected value="{{ $request_s->customer_id }}">
                                                        {{ App\User::findOrFail($request_s->customer_id)->name }}
                                                    </option>
                                                    @foreach(App\User::all()->except( $request_s->customer_id) as
                                                    $customer)
                                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('customer_id'))
                                                <span id="name-error" class="error text-danger"
                                                    for="customer_id">{{ $errors->first('customer_id') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-2 col-form-label" for="company_id">{{ __('Company') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group">

                                        <div class="col-md-10">
                                            <div class="select control">
                                                <select name="company_id" class="browser-default custom-select">
                                                    @if ($request_s->company_id)
                                                        <option selected value="{{ $request_s->company_id }}">
                                                            {{ App\Company::findOrFail($request_s->company_id)->name }}
                                                        </option>
                                                    @else
                                                        <option selected>Select Company</option>
                                                    @endif
                                                    @foreach(App\Company::all()->except( $request_s->company_id) as
                                                    $company)
                                                    <option value="{{$company->id}}">{{$company->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('company_id'))
                                                <span id="name-error" class="error text-danger"
                                                    for="company_id">{{ $errors->first('company_id') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-2 col-form-label" for="type">{{ __('Type') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group">

                                        <div class="col-md-10">
                                            <div class="select control">
                                                <select name="type" class="browser-default custom-select">
                                                    <option selected value="{{ $request_s->type }}">
                                                        {{ ucfirst($request_s->type) }}</option>
                                                    @foreach( $types as $type)
                                                    <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('type'))
                                                <span id="name-error" class="error text-danger"
                                                    for="type">{{ $errors->first('type') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-2 col-form-label" for="service_id">{{ __('Service') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group">

                                        <div class="col-md-10">
                                            <div class="select control">
                                                <select name="service_id" class="browser-default custom-select">
                                                    <option selected value="{{ $request_s->service_id }}">
                                                        {{ App\Models\Service\Service::findOrFail($request_s->service_id)->name_en }}
                                                    </option>
                                                    @foreach(App\Models\Service\Service::all()->where('is_sub',
                                                    1)->except($request_s->service_id) as $service)
                                                    <option value="{{$service->id}}">{{$service->name_en}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('service_id'))
                                                <span id="name-error" class="error text-danger"
                                                    for="service_id">{{ $errors->first('service_id') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Status') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}"
                                            name="status" id="input-name" type="text" placeholder="{{ __('Status') }}"
                                            value="{{ $request_s->status }}" required aria-required="true" />
                                        @if ($errors->has('status'))
                                        <span id="name-error" class="error text-danger"
                                            for="status">{{ $errors->first('status') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Note') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('note') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}"
                                            name="note" id="input-name" type="text" placeholder="{{ __('Note') }}"
                                            value="{{ $request_s->note }}" aria-required="true" />
                                        @if ($errors->has('note'))
                                        <span id="name-error" class="error text-danger"
                                            for="note">{{ $errors->first('note') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Location') }}</label>
                                <div class="col-sm-7">
                                    <a href="{{ route('map', ['request_s' => $request_s]) }}">
                                        <input class="btn btn-primary" type="button" value="View Location">
                                    </a>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
