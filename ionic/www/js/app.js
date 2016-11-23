angular.module( 'starter.controllers', [] );
angular.module( 'starter.services', [] );
angular.module( 'starter.filters', [] );

angular.module( 'starter', [
    'ionic', 'starter.controllers', 'starter.services','starter.filters', 'angular-oauth2', 'ngResource'
] )
    .constant( 'appConfig', {
        baseUrl: 'http://lacc_delivery.dev' //API laravel
    } )

    .run( function ( $ionicPlatform ) {

        $ionicPlatform.ready( function () {
            if ( window.cordova && window.cordova.plugins.Keyboard ) {
                // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
                // for form inputs)
                cordova.plugins.Keyboard.hideKeyboardAccessoryBar( true );

                // Don't remove this line unless you know what you are doing. It stops the viewport
                // from snapping when text inputs are focused. Ionic handles this internally for
                // a much nicer keyboard experience.
                cordova.plugins.Keyboard.disableScroll( true );
            }
            if ( window.StatusBar ) {
                StatusBar.styleDefault();
            }
        } );
    } )
    .config( function ( $stateProvider, $urlRouterProvider, OAuthProvider, OAuthTokenProvider, appConfig ) {

        OAuthProvider.configure( {
            baseUrl: appConfig.baseUrl,
            clientId: 'appid01',
            clientSecret: 'secret', // optional
            grantPath: '/oauth/access_token'
        } );

        OAuthTokenProvider.configure( {
            name: 'token',
            options: {
                secure: false //mudar para true quando for para produção (o server de produção tem que ter HTTPS)
            }
        } );

        $stateProvider
            .state( 'login', {
                url: '/login',
                templateUrl: 'templates/login.html',
                controller: 'LoginCtrl'
            } )
            .state( 'home', {
                url: '/home',
                templateUrl: 'templates/home.html',
                controller: 'HomeCtrl'
            } )
            //Rotas do client
            .state( 'client', {
                abstract: true,
                url: '/client',
                template: '<ion-nav-view/>'
            } )
            .state( 'client.checkout', {
                cache: false,
                url: '/checkout',
                templateUrl: 'templates/client/checkout.html',
                controller: 'ClientCheckoutCtrl'
            } )
            .state( 'client.checkout_item_detail', {
                url: '/checkout/detail/:index',
                templateUrl: 'templates/client/checkout-item-detail.html',
                controller: 'ClientCheckoutDetailCtrl'
            } )
            .state( 'client.checkout_successful', {
                cache: false,
                url: '/checkout/successful',
                templateUrl: 'templates/client/checkout-successful.html',
                controller: 'ClientCheckoutSuccessfulCtrl'
            } )
            .state( 'client.view_orders', {
                cache:false,
                url: '/view_orders/:id',
                templateUrl: 'templates/client/view-orders.html',
                controller: 'ClientViewOrderCtrl'
            } )
            .state( 'client.view_products', {
                url: '/view_products',
                templateUrl: 'templates/client/view-products.html',
                controller: 'ClientViewProductCtrl'
            } );

        // $urlRouterProvider.otherwise( '/' );
    } )
    .service( 'cart', function () {
        this.items = [];
    } );
