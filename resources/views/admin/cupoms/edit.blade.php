@extends('app')

@section('content')
    <div class="container">
        <h1>Edit Cupom: {{$cupom->name}}</h1>

        @include('errors._check')

        {!! Form::model($cupom,['route'=>['admin.cupoms.update','id'=>$cupom->id],'method'=>'put']) !!}

        @include('admin.cupoms._form')

        <div class="form-group text-center">
            {!! Form::submit('Edit', ['class'=>'btn btn-primary btn-sm']) !!}
            <a href="{{ route('admin.cupoms.index') }}" class="btn btn-warning btn-sm"> Return </a>
        </div>

        {!! Form::close() !!}
    </div>
@endsection