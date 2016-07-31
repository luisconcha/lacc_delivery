@extends('app')

@section('content')
    <div class="container">
        <h1>New Category</h1>

        @include('errors._check')

        {!! Form::open(['route'=>'admin.categories.store']) !!}

        @include('admin.categories._form')

        <div class="form-group text-center">
            {!! Form::submit('Save', ['class'=>'btn btn-primary btn-sm']) !!}
            <a href="{{ route('admin.categories.index') }}" class="btn btn-warning btn-sm"> Return </a>
        </div>

        {!! Form::close() !!}
    </div>
@endsection