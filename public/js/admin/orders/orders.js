$( document ).ready( function () {
    var obj = '';

    $( '#view-form-edit-orders' ).on( 'click', function ( e ) {
        e.preventDefault();
        obj = $( this ).data( 'element' );
        $( obj ).toggle();
    } );

    $( '.select-order' )
        .addClass( 'col-lg-6  show-tick ' )
        .selectpicker( {
            style: 'btn-info'
        } );

} );