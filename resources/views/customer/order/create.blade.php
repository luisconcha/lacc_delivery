@extends('app')

@section('content')
    <div class="container">
        <h1>New Order</h1>

        @include('errors._check')

        {!! Form::open(['route'=>'customer.order.store', 'class'=>'form']) !!}

        <div class="form-group">

            <label for="total">Total:</label>

            <p id="total"></p>

            <a href="#" class="btn btn-default" id="btn-new-item">New item</a>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbldy>
                    <tr>
                        <td>
                            {{--<select class="select-list-product" name="items[0][product_id]">--}}
                            <select class="form-control" name="items[0][product_id]">
                                {{--<select name="items[0][product_id]">--}}
                                @foreach($listProduct as $p)
                                    <option value="{{$p->id}}" data-price="{{$p->price}}"
                                            data-subtext="R${{$p->price}}">
                                        Product: {{$p->name}} (R${{$p->price}})
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            {!! Form::text('items[0][qtd]',1,['class'=>'form-control']) !!}
                        </td>
                    </tr>
                </tbldy>
            </table>
        </div>

        <div class="form-group text-center">
            {!! Form::submit('Create order', ['class'=>'btn btn-primary btn-sm']) !!}
            {{--<a href="{{ route('customer.order.create') }}" class="btn btn-warning btn-sm"> Return </a>--}}
        </div>

        {!! Form::close() !!}
    </div>
@endsection

@section('scripts')
    {!! Html::script('lib/bootstrap-select/js/bootstrap-select.js') !!}
    <script type="text/javascript">
        jQuery.noConflict();

        jQuery( '.select-list-product' ).selectpicker( {
            style: 'btn-primary'
        } );

        jQuery( '#btn-new-item' ).on( 'click', function ( e ) {
            var row    = jQuery( 'table tbody > tr:last' ),
                newRow = row.clone(),
                length = jQuery( "table tbody tr" ).length;

            newRow.find( 'td' ).each( function () {
                var td    = jQuery( this ),
                    input = td.find( 'input,select' ),
                    name  = input.attr( 'name' );
                input.attr( 'name', name.replace( ( length - 1 ) + "", length + "" ) );
            } );

            newRow.find( 'input' ).val( 1 );
            newRow.insertAfter( row );
            calculateTotal();
        } );

        /**
         * Como os tr são criados dinamicamente, utilizamos document.body
         */
        jQuery( document.body ).on( 'click', 'select', function () {
            calculateTotal();
        } );

        /**
         * Como os tr são criados dinamicamente, utilizamos document.body
         */
        jQuery( document.body ).on( 'blur', 'input', function () {
            calculateTotal();
        } );

        function calculateTotal() {
            var total = 0,
                trLen = jQuery( 'table tbody tr' ).length,
                tr    = null, price, qtd;

            for ( var i = 0 ; i < trLen ; i++ ) {
                tr    = jQuery( 'table tbody tr' ).eq( i );
                price = tr.find( ':selected' ).data( 'price' );
                qtd   = tr.find( 'input' ).val();
                total += price * qtd;
            }

            jQuery( '#total' ).html( total );
        }
    </script>
@endsection