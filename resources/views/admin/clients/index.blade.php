@extends('app')

@section('content')
    <div class="container">
        <h1 class="text-center">List of Clients</h1>

        <a href="{{route('admin.clients.create')}}" class="btn btn-primary btn-outline btn-sm">
            <i class="glyphicon glyphicon-plus"></i> <strong>New Client</strong>
        </a>
        <table class="table table-hover">
            <thead>
            <th>Id</th>
            <th>Name</th>
            <th>Action</th>
            </thead>

            <tbody>
            @foreach($listClients as $client)
                <tr>
                    <td>{{$client->id}}</td>
                    <td>{{$client->user->name}}</td>
                    <td>
                        <a href="{{route('admin.clients.edit',['id'=>$client->id])}}" class="btn btn-warning btn-outline btn-xs">
                            <i class="glyphicon glyphicon-edit"></i> <strong>Edit</strong>
                        </a>
                        <a href="{{route('admin.clients.destroy',['id'=>$client->id])}}" class="btn btn-danger btn-outline btn-xs">
                            <i class="glyphicon glyphicon-remove"></i> <strong>Delete</strong>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-center">{!!  $listClients->render() !!}</div>
    </div>
@endsection