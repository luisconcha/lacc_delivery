angular.module( 'starter.controllers' )
    .controller( 'ClientCheckoutSuccessfulCtrl',
        [ '$scope', '$state', '$cartService',
            function ( $scope, $state, $cartService ) {
                var cart     = $cartService.get();
                $scope.items = cart.items;
                $scope.total = $cartService.getTotalFinal();
                $scope.cupom = cart.cupom;

                $cartService.clear();

                $scope.openListOrder = function () {
                    $state.go( 'client.view_orders' );
                };
            } ] );