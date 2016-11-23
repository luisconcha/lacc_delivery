angular.module( 'starter.services' )
    .factory( 'UserFactory', [ '$resource', 'appConfig', function ( $resource, appConfig ) {
        var url = appConfig.baseUrl;
        return $resource( null, {}, {
            getUserAuthenticated: {
                url: url + '/api/authenticated',
                isArray: false
            }
        } )
    } ] );