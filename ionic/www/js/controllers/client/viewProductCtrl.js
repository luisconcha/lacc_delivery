angular.module( 'starter.controllers' )
    .controller( 'ClientViewProductCtrl', [
        '$scope', '$state', 'ProductFactory', '$ionicLoading', 'cart', '$localStorage',
        function ( $scope, $state, ProductFactory, $ionicLoading, cart, $localStorage ) {
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
            };

            console.log( $localStorage.setObject( 'LACC', {
                name: 'Luis Alberto Concha',
                numero: 20
            } ) );

        } ] );
