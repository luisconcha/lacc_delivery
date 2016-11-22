@extends('app')

@section('content')
    <div class="container">
        <h1>New Client</h1>

        @include('errors._check')

        {!! Form::model($client, ['route'=>'admin.clients.store']) !!}

        @include('admin.clients._form')

        <div class="form-group text-center">
            {!! Form::submit('Save', ['class'=>'btn btn-primary btn-sm']) !!}
            <a href="{{ route('admin.clients.index') }}" class="btn btn-warning btn-sm"> Return </a>
        </div>

        {!! Form::close() !!}
    </div>
@endsection