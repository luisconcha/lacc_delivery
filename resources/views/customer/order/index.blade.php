@extends('app')

@section('content')
    <div class="container">
        <h1 class="text-center">List of orders</h1>

        <a href="{{route('customer.order.create')}}" class="btn btn-primary btn-outline btn-sm">
            <i class="glyphicon glyphicon-plus"></i> <strong>New Order</strong>
        </a>
        <table class="table table-hover">
            <thead>
            <th>Id</th>
            <th>Total</th>
            <th>Status</th>
            <th>Action</th>
            </thead>
            <tbody>
            @foreach($listOrders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->total}}</td>
                    <td>{{$order->status}}</td>
                    <td>
                        {{--<a href="{{route('admin.clients.edit',['id'=>$client->id])}}" class="btn btn-warning btn-outline btn-xs">--}}
                            {{--<i class="glyphicon glyphicon-edit"></i> <strong>Edit</strong>--}}
                        {{--</a>--}}
                        {{--<a href="{{route('admin.clients.destroy',['id'=>$client->id])}}" class="btn btn-danger btn-outline btn-xs">--}}
                            {{--<i class="glyphicon glyphicon-remove"></i> <strong>Delete</strong>--}}
                        {{--</a>--}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-center">{!!  $listOrders->render() !!}</div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        jQuery.noConflict();
    </script>
@endsection