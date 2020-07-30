@extends('layouts.app', ['activePage' => 'offer-management', 'titlePage' => __('Offer Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ __('Offers') }}</h4>
                            <p class="card-category"> {{ __('Here you can manage offers') }}</p>
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
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <th>
                                        Id
                                    </th>
                                    <th>
                                        {{ __('Title') }}
                                    </th>
                                    <th>
                                        {{ __('Content') }}
                                    </th>
                                    <th>
                                        {{ __('Status') }}
                                    </th>
                                    <th>
                                        {{ __('Price') }}
                                    </th>
                                    <th>
                                        {{ __('Service Id') }}
                                    </th>
                                    <th>
                                        {{ __('Request Service Id') }}
                                    </th>
                                    <th>
                                        {{ __('Owner Request Id') }}
                                    </th>
                                    <th>
                                        {{ __('Company Id') }}
                                    </th>
                                    <th>
                                        {{ __('Creation date') }}
                                    </th>
                                    <th class="text-right">
                                        {{ __('Actions') }}
                                    </th>
                                    </thead>
                                    <tbody>
                                    @foreach($offers as $offer)
                                        <tr>
                                            <td>
                                                {{ $offer->id }}
                                            </td>
                                            <td>
                                                {{ $offer->title }}
                                            </td>
                                            <td>
                                                {{ $offer->content }}
                                            </td>
                                            <td>
                                                {{ $offer->status }}
                                            </td>
                                            <td>
                                                {{ $offer->price }}
                                            </td>
                                            <td>
                                                <a href="{{ route('service.sub.edit', ['service' => $offer->service_id]) }}">
                                                    {{ $offer->service_id }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('request.edit', ['request' => $offer->request_service_id]) }}">
                                                    {{ $offer->request_service_id }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('user.edit', ['user' => $offer->owner_request_id]) }}">
                                                    {{ $offer->owner_request_id }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('company.edit', ['company' => $offer->company_id]) }}">
                                                    {{ $offer->company_id }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ $offer->created_at->format('Y-m-d') }}
                                            </td>

                                            <td class="td-actions text-right">
                                                <form action="{{ route('offer.destroy', $offer) }}" method="post">
                                                    @csrf
                                                    @method('delete')

                                                    <button type="button" class="btn btn-danger btn-link"
                                                            data-original-title="" title=""
                                                            onclick="confirm('{{ __("Are you sure you want to delete this offer?") }}') ? this.parentElement.submit() : ''">
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
