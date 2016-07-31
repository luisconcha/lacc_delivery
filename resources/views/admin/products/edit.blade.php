@extends('app')

@section('content')
    <div class="container">
        <h1>Edit Product: {{$product->name}}</h1>

        @include('errors._check')

        {!! Form::model($product,['route'=>['admin.products.update','id'=>$product->id],'method'=>'put']) !!}

        @include('admin.products._form')

        <div class="form-group text-center">
            {!! Form::submit('Edit', ['class'=>'btn btn-primary btn-sm']) !!}
            <a href="{{ route('admin.products.index') }}" class="btn btn-warning btn-sm"> Return </a>
        </div>

        {!! Form::close() !!}
    </div>
@endsection