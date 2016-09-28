@extends('app')

@section('content')
    <div class="container">
        <h1>New Cupom</h1>

        @include('errors._check')

        {!! Form::open(['route'=>'admin.cupoms.store']) !!}

        @include('admin.cupoms._form')

        <div class="form-group text-center">
            {!! Form::submit('Save', ['class'=>'btn btn-primary btn-sm']) !!}
            <a href="{{ route('admin.cupoms.index') }}" class="btn btn-warning btn-sm"> Return </a>
        </div>

        {!! Form::close() !!}
    </div>
@endsection