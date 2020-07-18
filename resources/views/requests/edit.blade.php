@extends('layouts.app', ['activePage' => 'request-management', 'titlePage' => __('Request Management')])

@section('head')
{!! $map['js'] !!}
@endsection

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
                                <label class="col-sm-2 col-form-label">{{ __('Note') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('note') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}"
                                            name="note" id="input-name" type="text" placeholder="{{ __('Note') }}"
                                            value="{{ old('note', $request_s->note) }}" required="true"
                                            aria-required="true" />
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
                                    <a href="{{ route('map') }}">
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
