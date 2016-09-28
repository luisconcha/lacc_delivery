@extends('app')

@section('content')
    <div class="container">
        <h2>Edit order of the customer: <span class="label label-info">{{$order->client->user->name}}</span></h2>

        @include('errors._check')

        <div class="row">
            <div class="col-xs-12">
                <div class="invoice-title">
                    <h3>Delivery address</h3>
                </div>
                <small>{{$order->client->address}}</small>
                <div class="row">
                    <div class="col-md-4 text-right"><h3>Order # {{$order->id}}</h3></div>
                    <div class="col-md-4 text-right"><h3>Status <span
                                    class="label label-{{$order->status}}">{{$order->status}}</span></h3></div>
                    <div class="col-md-4 text-right"><h3>Deliveryman <span
                                    class="label label-default">{{$order->deliveryman ? $order->deliveryman->name : 'There is no deliveryman for this order'}}</span></h3></div>
                </div>
                <hr>
                <div class="invoice-title">
                    <h4>
                        <a href="#" id="view-form-edit-orders" data-element="#block-form-edit-orders">Edit status and
                            delivery man ?</a>
                    </h4>
                </div>
                <hr>

                <div class="row" id="block-form-edit-orders">
                    <div class="col-xs-12">
                        @include('admin.orders.includes.form-edit-status-and-deliveryman')
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6">
                        <address>
                            <strong>Billed To:</strong><br>
                            <span class="font-bold">Address: </span>{{$order->client->address}}<br>
                            <span class="font-bold">State: </span>{{$order->client->state}}<br>
                            <span class="font-bold">City: </span>{{$order->client->city}}<br>
                            <span class="font-bold">ZipCode: </span>{{$order->client->zipcode}}
                        </address>
                    </div>
                    <div class="col-xs-4 text-right">
                        <address>
                            <address>
                                <strong>Contact details:</strong><br>
                                {{$order->client->phone}}<br>
                                {{$order->client->user->email}}
                            </address>
                        </address>
                    </div>
                    <div class="col-xs-2 text-right">
                        <address>
                            <address>
                                <strong>Order Date:</strong><br>
                                {{dataHoraMinutoBR($order->created_at)}}<br><br>
                            </address>
                        </address>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 text-right">

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Order summary</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                <tr>
                                    <td><strong>Item</strong></td>
                                    <td class="text-center"><strong>Price</strong></td>
                                    <td class="text-center"><strong>Quantity</strong></td>
                                    <td class="text-right"><strong>Totals</strong></td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->items as $item)
                                    {{$totalPurchase += $item->product->price * $item->qtd}}
                                    <tr>
                                        <td>{{$item->product->name}}</td>
                                        <td class="text-center">R$ {{$item->product->price}}</td>
                                        <td class="text-center">{{$item->qtd}}</td>
                                        <td class="text-right">R$ {{$item->product->price * $item->qtd}}</td>
                                    </tr>
                                @endforeach
                                <tr class="tr-total-purchase">
                                    <td>Total purchase:</td>
                                    <td colspan="3" class="text-right">
                                        <span class="label label-primary totalPurchase">R$ {{$totalPurchase}}</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div>
                    <a href="{{route('admin.orders.index')}}" class="btn btn-primary btn-lg btn-block">
                        Return list of orders
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('js/admin/orders/orders.js') !!}
@endsection