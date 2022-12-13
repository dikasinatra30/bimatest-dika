@extends('layouts.app')

@push('styles')
    <style type="text/css">
        .pagination li{
            float: left;
            list-style-type: none;
            margin:5px;
        }
    </style>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Orders') }}</div>

                <div class="card-body">
                    <div>
                        <table class="table">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Code</th>
                                <th scope="col">Name</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Reff</th>
                                <th scope="col">Expired</th>
                                <th scope="col">Paid</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $key => $order)
                                    <tr>
                                        <th scope="row">{{ $orders->firstItem() + $key }}</th>
                                        <td>{{ $order->code }}</th>
                                        <td>{{ $order->amount }}</th>
                                        <td>{{ $order->reff }}</th>
                                        <td>{{ Carbon\Carbon::parse($order->expired_at) }}</th>
                                        <td>{{ Carbon\Carbon::parse($order->paid_at) }}</th>
                                        <td>{{ $order->statusLabel }}</th>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
