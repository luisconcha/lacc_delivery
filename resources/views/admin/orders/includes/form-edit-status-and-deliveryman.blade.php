{!! Form::model($order,['route'=>['admin.orders.update', 'id'=>$order->id],'method'=>'put']) !!}

<div class="row">
    <div class="col-xs-6">
        <div class="form-group">
            {!! Form::label('name','Status of Order') !!}
            {!! Form::select('status',$arrStatus, $selectedStatus, ['class'=>'form-control select-order']) !!}
        </div>
    </div>
    <div class="col-xs-6">
        <div class="form-group">
            {!! Form::label('name','Deliveryman') !!}
            {!! Form::select('user_deliveryman_id',$listDeliveryman, null, ['class'=>'form-control select-order']) !!}
        </div>
    </div>
</div>


<div class="form-group text-center">
    {!! Form::submit('Update order', ['class'=>'btn btn-warning btn-sm']) !!}
</div>

{!! Form::close() !!}