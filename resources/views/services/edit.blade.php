@extends('layouts.app', ['activePage' => 'service-management', 'titlePage' => __('Service Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('service.update', $service) }}" autocomplete="off"
                          class="form-horizontal">
                        @csrf
                        @method('put')

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Edit Service') }}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="{{ route('service.index') }}"
                                           class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Name in Arabic') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('name_ar') ? ' has-danger' : '' }}">
                                            <input
                                                class="form-control{{ $errors->has('name_ar') ? ' is-invalid' : '' }}"
                                                name="name_ar" id="input-name" type="text"
                                                placeholder="{{ __('Name in Arabic') }}"
                                                value="{{ old('name_ar', $service->name_ar) }}"
                                                required="true" aria-required="true"/>
                                            @if ($errors->has('name_ar'))
                                                <span id="name-error" class="error text-danger"
                                                      for="input-name">{{ $errors->first('name_ar') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Name in English') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('name_en') ? ' has-danger' : '' }}">
                                            <input
                                                class="form-control{{ $errors->has('name_en') ? ' is-invalid' : '' }}"
                                                name="name_en" id="input-name" type="text"
                                                placeholder="{{ __('Name in English') }}"
                                                value="{{ old('name_en', $service->name_en) }}"
                                                required="true" aria-required="true"/>
                                            @if ($errors->has('name_en'))
                                                <span id="name-error" class="error text-danger"
                                                      for="input-name">{{ $errors->first('name_en') }}</span>
                                            @endif
                                        </div>
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
