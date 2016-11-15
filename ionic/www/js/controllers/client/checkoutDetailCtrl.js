angular.module( 'starter.controllers' )
    .controller( 'ClientCheckoutDetailCtrl',
        [ '$scope', '$state', '$stateParams', '$cartService',
            function ( $scope, $state, $stateParams, $cartService ) {

                $scope.product = $cartService.getItem( $stateParams.index );

                $scope.updateQtd = function () {
                    $cartService.updateQtd( $stateParams.index, $scope.product.qtd );
                    $state.go( 'client.checkout' );
                };
            } ] );