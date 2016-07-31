@extends('app')

@section('content')
    <div class="container">
        <h1 class="text-center">List of Orders</h1>

        {{--<a href="{{route('admin.clients.create')}}" class="btn btn-primary">New Client</a>--}}
        <div class="row">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Client Name</th>
                        <th>Total</th>
                        <th>Data</th>
                        <th>Itens</th>
                        <th>Status</th>
                        <th>Delivery man</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($listOrders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->client->user->name}}</td>
                            <td>R$ {{$order->total}}</td>
                            <td>{{dataHoraMinutoBR($order->created_at)}}</td>
                            <td>
                                <ul>
                                    @foreach($order->items as $item)
                                        <li>{{$item->product->name}}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <span class="label label-{{$order->status}}">{{$order->status}}</span>
                            </td>
                            <td>{{($order->deliveryman) ? $order->deliveryman->name : '****'}}</td>
                            <td>
                                <a href="{{route('admin.orders.edit',['id'=>$order->id])}}" class="btn btn-warning btn-outline btn-xs">
                                    <i class="glyphicon glyphicon-edit"></i> <strong>Edit</strong>
                                </a>
                                {{--<a href="{{route('admin.clients.destroy',['id'=>$order->id])}}">Excluir</a>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">{!!  $listOrders->render() !!}</div>
            </div>
        </div>
    </div>
@endsection