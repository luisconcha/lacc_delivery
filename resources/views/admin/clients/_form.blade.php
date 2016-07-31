<div class="form-group">
    {!! Form::label('Name','Name:') !!}
    {!! Form::text('user[name]', null, ['placeholder'=>'Enter the name:','class'=>'form-control', 'id'=>'name']) !!}
</div>

<div class="form-group">
    {!! Form::label('Email','Email:') !!}
    {!! Form::text('user[email]', null, ['placeholder'=>'Enter the email:','class'=>'form-control', 'id'=>'email']) !!}
</div>

<div class="form-group">
    {!! Form::label('Phone','Phone:') !!}
    {!! Form::text('phone', null, ['placeholder'=>'Enter the phone:','class'=>'form-control', 'id'=>'phone']) !!}
</div>

<div class="form-group">
    {!! Form::label('Address','Address') !!}
    {!! Form::textarea('address',null, ['placeholder'=>'Enter the Address','class'=>'form-control', 'id'=>'address','rows'=>'3']) !!}
</div>

<div class="form-group">
    {!! Form::label('City','City:') !!}
    {!! Form::text('city', null, ['placeholder'=>'Enter the City:','class'=>'form-control', 'id'=>'city']) !!}
</div>

<div class="form-group">
    {!! Form::label('State','State:') !!}
    {!! Form::text('state', null, ['placeholder'=>'Enter the State:','class'=>'form-control', 'id'=>'state']) !!}
</div>

<div class="form-group">
    {!! Form::label('ZipCode','ZipCode:') !!}
    {!! Form::text('zipcode', null, ['placeholder'=>'Enter the zipcode:','class'=>'form-control', 'id'=>'zipcode']) !!}
</div>

