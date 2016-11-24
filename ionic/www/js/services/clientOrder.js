angular.module( 'starter.services' )
    .factory( 'ClientOrderFactory',
        [ '$resource', 'appConfig', function ( $resource, appConfig ) {

            var url = appConfig.baseUrl + '/api/client/order';

            return $resource( url , {}, {
                query: {
                    isArray: false
                }
            } );
        } ] );