angular.module( 'starter.controllers' )
    .controller( 'LoginCtrl',
        [ '$scope', '$cookies', 'OAuth', '$ionicPopup', '$state', 'UserFactory',
            function ( $scope, $cookies, OAuth, $ionicPopup, $state, UserFactory ) {

                $scope.user = {
                    username: '',
                    password: ''
                };

                $scope.login = function () {
                    OAuth.getAccessToken( $scope.user ).then( function () {
                        UserFactory.getUserAuthenticated( {}, {}, function ( data ) {
                            console.log( 'Obj: ', data );
                            $cookies.putObject( 'user', data );
                            $state.go( 'client.checkout' );
                        } );
                    }, function ( responseError ) {
                        $ionicPopup.alert( {
                            title: 'warning',
                            template: 'Login or password invalid'
                        } );
                        console.log( 'responseError: ', responseError );
                    } );

                };

            } ] );