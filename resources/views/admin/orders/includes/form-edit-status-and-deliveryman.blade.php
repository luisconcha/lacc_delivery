{!! Form::model($order,['route'=>['admin.orders.update', 'id'=>$order->id],'method'=>'put']) !!}

<div class="form-group">
    {!! Form::label('name','Status of Order') !!}
    {!! Form::select('status',$arrStatus, $selectedStatus, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('name','Deliveryman') !!}
    {!! Form::select('user_deliveryman_id',$listDeliveryman, null, ['class'=>'form-control']) !!}
</div>


<div class="form-group text-center">
    {!! Form::submit('Update order', ['class'=>'btn btn-primary btn-sm']) !!}
</div>

{!! Form::close() !!}