angular.module( 'starter.controllers' )
    .controller( 'ClientCheckoutCtrl', [
        '$scope', 'cart', '$localStorage',
        function ( $scope, cart, $localStorage ) {

            $scope.items = cart.items;

            console.log($localStorage.getObject());
        } ] );