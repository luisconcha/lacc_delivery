@extends('app')

@section('content')
    <div class="container">
        <h1 class="text-center">List of Products</h1>

        <a href="{{route('admin.products.create')}}" class="btn btn-primary btn-outline btn-sm">
            <i class="glyphicon glyphicon-plus"></i> <strong>New Product</strong>
        </a>
        <table class="table table-hover">
            <thead>
            <th>Id</th>
            <th>Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Action</th>
            </thead>

            <tbody>
            @foreach($listProducts as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->category->name}}</td>
                    <td>{{$product->description}}</td>
                    <td>
                        <a href="{{route('admin.products.edit',['id'=>$product->id])}}" class="btn btn-warning btn-outline btn-xs">
                            <i class="glyphicon glyphicon-edit"></i> <strong>Edit</strong>
                        </a>
                        <a href="{{route('admin.products.destroy',['id'=>$product->id])}}" class="btn btn-danger btn-outline btn-xs">
                            <i class="glyphicon glyphicon-remove"></i> <strong>Delete</strong>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-center">{!!  $listProducts->render() !!}</div>
    </div>
@endsection