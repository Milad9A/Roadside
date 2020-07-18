@extends('layouts.app', ['activePage' => 'service-management', 'titlePage' => __('Service Management')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ route('service.update', $service) }}" autocomplete="off"
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
                            <div class="row" style="margin-bottom: 50px">
                                <label class="col-sm-2 col-form-label">{{ __('Photo') }}</label>
                                <div class="col-sm-4">
                                    <img src="{{ asset($service->photo) }}" alt="" width="400px">
                                </div>
                                <div class="col-sm-1">
                                    <input class="fa-file @error('photo') is-danger @enderror" name="photo" type="file"
                                        value="{{ old('photo') }}">
                                    @if ($errors->has('photo'))
                                    <span id="name-error" class="error text-danger"
                                        for="photo">{{ $errors->first('photo') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 50px">
                                <label class="col-sm-2 col-form-label">{{ __('Photo Selected') }}</label>
                                <div class="col-sm-4">
                                    <img src="{{ asset($service->photo_selected) }}" alt="" width="400px"
                                        style="background-color: black">
                                </div>
                                <div class="col-sm-1">
                                    <input class="fa-file @error('photo_selected') is-danger @enderror"
                                        name="photo_selected" type="file" value="{{ old('photo_selected') }}">
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Name in Arabic') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('name_ar') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('name_ar') ? ' is-invalid' : '' }}"
                                            name="name_ar" id="input-name" type="text"
                                            placeholder="{{ __('Name in Arabic') }}"
                                            value="{{ old('name_ar', $service->name_ar) }}" required="true"
                                            aria-required="true" />
                                        @if ($errors->has('name_ar'))
                                        <span id="name-error" class="error text-danger"
                                            for="name_ar">{{ $errors->first('name_ar') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Name in English') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('name_en') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('name_en') ? ' is-invalid' : '' }}"
                                            name="name_en" id="input-name" type="text"
                                            placeholder="{{ __('Name in English') }}"
                                            value="{{ old('name_en', $service->name_en) }}" required="true"
                                            aria-required="true" />
                                        @if ($errors->has('name_en'))
                                        <span id="name-error" class="error text-danger"
                                            for="name_en">{{ $errors->first('name_en') }}</span>
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


                <div class="card mt-5">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">{{ __('Sub Services') }}</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body">

                        @if (App\Models\Service\Service::all()->where('service_id', $service->id)->count() > 0)

                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        {{ __('Name in Arabic') }}
                                    </th>
                                    <th>
                                        {{ __('Name in English') }}
                                    </th>
                                    <th>
                                        {{ __('Creation date') }}
                                    </th>
                                    <th class="text-right">
                                        {{ __('Actions') }}
                                    </th>
                                </thead>
                                <tbody>

                                    @foreach (App\Models\Service\Service::all()->where('service_id', $service->id) as
                                    $sub)
                                    <tr>
                                        <td>
                                            {{ $sub->name_ar }}
                                        </td>
                                        <td>
                                            {{ $sub->name_en }}
                                        </td>
                                        <td>
                                            {{ $sub->created_at->format('Y-m-d') }}
                                        </td>

                                        <td class="td-actions text-right">
                                            <form action="{{ route('service.sub.destroy', $sub) }}" method="post">
                                                @csrf
                                                @method('delete')

                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                    href="{{ route('service.sub.edit', $sub) }}" data-original-title=""
                                                    title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-link"
                                                    data-original-title="" title=""
                                                    onclick="confirm('{{ __("Are you sure you want to delete this sub service?") }}') ? this.parentElement.submit() : ''">
                                                    <i class="material-icons">close</i>
                                                    <div class="ripple-container"></div>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @else
                        <div class="row" style="margin-bottom: 20px">
                            <p class="col-sm-4 col-form-label">This service does not have any sub services</p>
                        </div>
                        @endif

                    </div>
                </div>


                <form method="post" action="{{ route('service.sub.store', $service->id) }}" autocomplete="off"
                    class="form-horizontal">
                    @csrf
                    @method('post')

                    <div class="card mt-5">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('Add Sub Services to this Service') }}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Name in Arabic') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('name_ar') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('name_ar') ? ' is-invalid' : '' }}"
                                            name="name_ar" id="input-name" type="text"
                                            placeholder="{{ __('Name in Arabic') }}" value="{{ old('name_ar') }}"
                                            required="true" aria-required="true" />
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
                                        <input class="form-control{{ $errors->has('name_en') ? ' is-invalid' : '' }}"
                                            name="name_en" id="input-name" type="text"
                                            placeholder="{{ __('Name in English') }}" value="{{ old('name_en') }}"
                                            required="true" aria-required="true" />
                                        @if ($errors->has('name_en'))
                                        <span id="name-error" class="error text-danger"
                                            for="input-name">{{ $errors->first('name_en') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary">{{ __('Add Sub Service') }}</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
