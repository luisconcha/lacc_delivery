angular.module( 'starter.controllers' )
    .controller( 'ClientViewProductCtrl', [
        '$scope', '$state', 'ProductFactory', '$ionicLoading', 'cart',
        function ( $scope, $state, ProductFactory, $ionicLoading, cart ) {
            $scope.products = [];

            $ionicLoading.show( {
                template: 'Loading.....'
            } );

            ProductFactory.query( {}, function ( data ) {
                $scope.products = data.data;
                $ionicLoading.hide();
            }, function ( dataError ) {
                $ionicLoading.hide();
            } );

            $scope.addItem = function ( item ) {
                cart.items.push( item );
                $state.go( 'client.checkout' );
            }

        } ] );
