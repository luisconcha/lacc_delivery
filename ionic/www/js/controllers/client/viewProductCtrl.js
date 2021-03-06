angular.module( 'starter.controllers' )
    .controller( 'ClientViewProductCtrl', [
        '$scope', '$state', 'ProductFactory', '$ionicLoading', '$cartService',
        function ( $scope, $state, ProductFactory, $ionicLoading, $cartService ) {
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
                item.qtd = 1;
                $cartService.addItem( item );
                $state.go( 'client.checkout' );
            };

        } ] );
