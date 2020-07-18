@extends('layouts.app', ['activePage' => 'request-management', 'titlePage' => __('Request Management')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{ __('Requests') }}</h4>
                        <p class="card-category"> {{ __('Here you can manage Requests') }}</p>
                    </div>
                    <div class="card-body">
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
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{ route('request.create') }}"
                                    class="btn btn-sm btn-primary">{{ __('Add Request') }}</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        Id
                                    </th>
                                    <th>
                                        {{ __('Customer') }}
                                    </th>
                                    <th>
                                        {{ __('Company Id') }}
                                    </th>
                                    <th>
                                        {{ __('Service Id') }}
                                    </th>
                                    <th>
                                        {{ __('Type') }}
                                    </th>
                                    <th>
                                        {{ __('Status') }}
                                    </th>
                                    <th>
                                        {{ __('Creation date') }}
                                    </th>
                                    <th class="text-right">
                                        {{ __('Actions') }}
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach($request_services as $request_s)
                                    <tr>
                                        <td>
                                            {{ $request_s->id }}
                                        </td>
                                        <td>
                                            {{ $request_s->customer->name }}
                                        </td>
                                        <td>
                                            {{ $request_s->company->name }}
                                        </td>
                                        <td>
                                            {{ $request_s->service_id }}
                                        </td>
                                        <td>
                                            {{ $request_s->type }}
                                        </td>
                                        <td>
                                            {{ $request_s->status }}
                                        </td>
                                        <td>
                                            {{ $request_s->created_at->format('Y-m-d') }}
                                        </td>

                                        <td class="td-actions text-right">
                                            <form action="{{ route('request.destroy', $request_s) }}" method="post">
                                                @csrf
                                                @method('delete')

                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                    href="{{ route('request.edit', $request_s) }}" data-original-title=""
                                                    title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-link"
                                                    data-original-title="" title=""
                                                    onclick="confirm('{{ __("Are you sure you want to delete this request?") }}') ? this.parentElement.submit() : ''">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
