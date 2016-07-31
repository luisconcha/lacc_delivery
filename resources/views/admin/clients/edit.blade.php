@extends('app')

@section('content')
    <div class="container">
        <h1>Edit Client: {{$client->user->name}}</h1>

        @include('errors._check')

        {!! Form::model($client,['route'=>['admin.clients.update','id'=>$client->id],'method'=>'put']) !!}

        @include('admin.clients._form')

        <div class="form-group text-center">
            {!! Form::submit('Edit', ['class'=>'btn btn-primary btn-sm']) !!}
            <a href="{{ route('admin.clients.index') }}" class="btn btn-warning btn-sm"> Return </a>
        </div>

        {!! Form::close() !!}
    </div>
@endsection