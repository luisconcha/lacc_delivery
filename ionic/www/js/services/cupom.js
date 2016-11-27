angular.module( 'starter.services' )
    .factory( 'CupomFactory', [ '$resource', 'appConfig', function ( $resource, appConfig ) {

        return $resource( appConfig.baseUrl + '/api/cupom/:cupomCode', { cupomCode: '@cupomCode' }, {
            query: {
                isArray: false
            }
        } );
    } ] );