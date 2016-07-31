$( document ).ready( function () {
    var obj = '';

    $( '#view-form-edit-orders' ).on( 'click', function ( e ) {
        e.preventDefault();
        obj = $( this ).data( 'element' );
        $( obj ).toggle();
    } );
} );