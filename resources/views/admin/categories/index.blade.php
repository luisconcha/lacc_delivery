@extends('app')

@section('content')
    <div class="container">
        <h1 class="text-center">List of Categories</h1>
        <a href="{{route('admin.categories.create')}}" class="btn btn-primary btn-outline btn-sm">
            <i class="glyphicon glyphicon-plus"></i> <strong>New Category</strong>
        </a>
        <table class="table table-hover">
            <thead>
            <th>Id</th>
            <th>Name</th>
            <th>Action</th>
            </thead>

            <tbody>
            @foreach($listCategories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>
                        <a href="{{route('admin.categories.edit',['id'=>$category->id])}}" class="btn btn-warning btn-outline btn-xs">
                            <i class="glyphicon glyphicon-edit"></i> <strong>Edit</strong>
                        </a>
                        <a href="{{route('admin.categories.destroy',['id'=>$category->id])}}" class="btn btn-danger btn-outline btn-xs">
                            <i class="glyphicon glyphicon-remove"></i> <strong>Delete</strong>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-center">{!!  $listCategories->render() !!}</div>
    </div>
@endsection