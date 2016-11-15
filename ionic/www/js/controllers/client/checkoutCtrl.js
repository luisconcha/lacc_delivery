angular.module( 'starter.controllers' )
    .controller( 'ClientCheckoutCtrl', [
        '$scope', '$state', '$cartService', 'OrderFactory', '$ionicLoading', '$ionicPopup',
        function ( $scope, $state, $cartService, OrderFactory, $ionicLoading, $ionicPopup ) {

            var cart     = $cartService.get();
            $scope.items = cart.items;
            $scope.total = cart.total;

            $scope.removeItem = function ( item ) {
                //remove do carrinho
                $cartService.removeItem( item );
                //remove da listagem
                $scope.items.splice( item, 1 );
                //calcula o total
                $scope.total = $cartService.get().total;
            };

            $scope.openProductDetail = function ( item ) {
                $state.go( 'client.checkout_item_detail', {
                    index: item
                } )
            };

            $scope.openListProducts = function () {
                $state.go( 'client.view_products' );
            };

            $scope.save = function () {
                var items = angular.copy( $scope.items );
                angular.forEach( items, function ( item ) {
                    item.product_id = item.id;
                } );

                $ionicLoading.show( {
                    template: 'Saving data, please wait ...'
                } );

                OrderFactory.save( { id: null }, { items: items }, function ( data ) {
                    $ionicLoading.hide();
                    $state.go( 'client.checkout_successful' );
                }, function ( responseError ) {
                    $ionicPopup.alert( {
                        title: 'Error',
                        template: 'Your request has not been processed. Please try again.'
                    } );
                    $ionicLoading.hide();
                } );
            };
        } ] );