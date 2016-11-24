angular.module( 'starter.controllers' )
    .controller( 'ClientViewOrderCtrl',
        [ '$scope', '$state', '$stateParams', 'ClientOrderFactory', '$ionicLoading',
            function ( $scope, $state, $stateParams, ClientOrderFactory, $ionicLoading ) {

                $scope.orders = [];

                $ionicLoading.show( {
                    template: 'Loading orders...'
                } );

                ClientOrderFactory.get( {}, function ( data ) {
                    var orders = data.data;
                    angular.forEach( orders, function ( order ) {

                        switch ( order.status ) {
                            case 0:
                                order.status = 'Processing';
                                break;
                            case 1:
                                order.status = 'Shipped';
                                break;
                            case 2:
                                order.status = 'Completed';
                                break;
                            case 3:
                                order.status = 'Suspended';
                                break;
                            case 4:
                                order.status = 'Unknown';
                                break;
                        }
                    } );

                    $scope.orders = orders;

                    $ionicLoading.hide();
                }, function ( responseError ) {
                    $ionicLoading.hide();
                } );

            } ] );