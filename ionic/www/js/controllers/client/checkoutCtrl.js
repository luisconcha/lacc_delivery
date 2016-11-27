angular.module( 'starter.controllers' )
    .controller( 'ClientCheckoutCtrl', [
        '$scope', '$state', '$cartService', 'OrderFactory', '$ionicLoading', '$ionicPopup', 'CupomFactory',
        function ( $scope, $state, $cartService, OrderFactory, $ionicLoading, $ionicPopup, CupomFactory ) {

            var cart     = $cartService.get();
            $scope.items = cart.items;
            $scope.cupom = cart.cupom;
            $scope.total = $cartService.getTotalFinal();

            $scope.removeItem = function ( item ) {
                //remove do carrinho
                $cartService.removeItem( item );
                //remove da listagem
                $scope.items.splice( item, 1 );
                //calcula o total
                $scope.total = $cartService.getTotalFinal();
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
                var o = {
                    items: angular.copy( $scope.items )
                };
                console.log( 'Obj: ', o );
                angular.forEach( o.items, function ( item ) {
                    item.product_id = item.id;
                } );

                $ionicLoading.show( {
                    template: 'Saving data, please wait ...'
                } );

                if ( $scope.cupom.value ) {
                    o.cupom_code = $scope.cupom.code;
                }

                OrderFactory.save( { id: null }, o, function ( data ) {
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

            $scope.readyBarCode = function () {
                getValueCupom( 586 );
            };

            $scope.removeCupom = function () {
                var confirmRemove = $ionicPopup.confirm( {
                    title: 'LACC-Delivery',
                    template: 'Do you want to remove the coupon?'
                } );
                confirmRemove.then( function ( response ) {
                    console.log( 'Obj: ', response );
                    if ( response ) {
                        $cartService.removeCupom();
                        $scope.cupom = $cartService.get().cupom;
                        $scope.total = $cartService.getTotalFinal();
                    } else {
                        console.log( 'Cupom não foi removido' );
                    }
                } );
            };

            function getValueCupom( cupomCode ) {
                $ionicLoading.show( {
                    template: 'Loading...'
                } );
                CupomFactory.get( { cupomCode: cupomCode }, function ( data ) {
                    $cartService.setCupom( data.data.code, data.data.value );
                    $scope.cupom = $cartService.get().cupom;
                    $scope.total = $cartService.getTotalFinal();
                    $ionicLoading.hide();
                }, function ( responseError ) {
                    $ionicLoading.hide();
                    $ionicPopup.alert( {
                        title: 'Error',
                        template: 'Invalid Cupom. Please inform another coupon.'
                    } );
                } )
            }
        } ] );