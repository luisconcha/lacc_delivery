angular.module( 'starter.services' )
    .factory( 'ClientOrderFactory',
        [ '$resource', 'appConfig', function ( $resource, appConfig ) {

            var url = appConfig.baseUrl + '/api/client/order/:id';

            return $resource( url , { id: '@id' }, {
                query: {
                    isArray: false
                }
            } );
        } ] );