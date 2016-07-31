@extends('app')

@section('content')
    <div class="container">
        <h1>Edit Category: {{$category->name}}</h1>

        @include('errors._check')

        {!! Form::model($category,['route'=>['admin.categories.update','id'=>$category->id],'method'=>'put']) !!}

        @include('admin.categories._form')

        <div class="form-group text-center">
            {!! Form::submit('Edit', ['class'=>'btn btn-primary btn-sm']) !!}
            <a href="{{ route('admin.categories.index') }}" class="btn btn-warning btn-sm"> Return </a>
        </div>

        {!! Form::close() !!}
    </div>
@endsection