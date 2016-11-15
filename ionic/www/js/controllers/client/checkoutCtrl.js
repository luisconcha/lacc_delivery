angular.module( 'starter.controllers' )
    .controller( 'ClientCheckoutCtrl', [
        '$scope','cart',
        function ( $scope, cart ) {

        $scope.items = cart.items;

        console.log('$scope.items: ',$scope.items);
    } ] );