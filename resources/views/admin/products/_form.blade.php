<div class="form-group">
    {!! Form::label('name','Categories') !!}
    {!! Form::select('category_id',$categories, null, ['class'=>'form-control']) !!}
</div>


<div class="form-group">
    {!! Form::label('Name','Name:') !!}
    {!! Form::text('name', null, ['placeholder'=>'Enter the name:','class'=>'form-control', 'id'=>'name']) !!}
</div>

<div class="form-group">
    {!! Form::label('Description','Description:') !!}
    {!! Form::textarea('description', null, ['placeholder'=>'Enter the description:','class'=>'form-control', 'id'=>'description','rows'=>'3']) !!}
</div>

<div class="form-group">
    {!! Form::label('Price','Price:') !!}
    {!! Form::text('price', null, ['placeholder'=>'what is the price?:','class'=>'form-control', 'id'=>'price']) !!}
</div>
