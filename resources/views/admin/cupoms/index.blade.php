@extends('app')

@section('content')
    <div class="container">
        <h1 class="text-center">List of Cupoms</h1>
        <a href="{{route('admin.cupoms.create')}}" class="btn btn-primary btn-outline btn-sm">
            <i class="glyphicon glyphicon-plus"></i> <strong>New Cupom</strong>
        </a>
        <table class="table table-hover">
            <thead>
            <th>Id</th>
            <th>Code</th>
            <th>Value (R$)</th>
            <th>Action</th>
            </thead>

            <tbody>
            @foreach($listCupoms as $cupom)
                <tr>
                    <td>{{$cupom->id}}</td>
                    <td>{{$cupom->code}}</td>
                    <td>R$ {{priceBR($cupom->value)}}</td>
                    <td>
                        <a href="{{route('admin.cupoms.edit',['id'=>$cupom->id])}}"
                           class="btn btn-warning btn-outline btn-xs">
                            <i class="glyphicon glyphicon-edit"></i> <strong>Edit</strong>
                        </a>
                        <a href="{{route('admin.cupoms.destroy',['id'=>$cupom->id])}}"
                           class="btn btn-danger btn-outline btn-xs">
                            <i class="glyphicon glyphicon-remove"></i> <strong>Delete</strong>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-center">{!! $listCupoms->render() !!}</div>
    </div>
@endsection