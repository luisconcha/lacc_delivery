@extends('app')

@section('content')
    <div class="container">
        <h1>New Product</h1>

        @include('errors._check')

        {!! Form::open(['route'=>'admin.products.store']) !!}

        @include('admin.products._form')

        <div class="form-group text-center">
            {!! Form::submit('Save', ['class'=>'btn btn-primary btn-sm']) !!}
            <a href="{{ route('admin.products.index') }}" class="btn btn-warning btn-sm"> Return </a>
        </div>

        {!! Form::close() !!}
    </div>
@endsection