angular.module( 'starter.controllers' )
    .controller( 'HomeCtrl', [ '$scope', '$cookies',
        function ( $scope, $cookies ) {
            $scope.user_name = $cookies.getObject( 'user' ).name;

        } ] );