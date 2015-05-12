define( [
    'angular',
    'angular-route',
    'angular-animate',
    'angular-aria',
    'angular-material',
    'angular-resource',
    'uiRouter',
    'welcome/welcome',
    'service/name-service',
    'service/branch-resource'
  ],
  function(angular) {
    'use strict';

    var appName = 'reviewApp';

    angular.module(appName, [
      'ngRoute',
      'ngMaterial',
      'reviewApp.welcome',
      'reviewApp.name-service',
      'reviewApp.branch-resource'
    ])

    .config(['$routeProvider', '$mdThemingProvider',
        function appConfig($urlRouteProvider, $mdThemingProvider) {

      $urlRouteProvider.otherwise('/welcome');

      $mdThemingProvider.theme('default')
        .primaryPalette('teal')
        .accentPalette('deep-orange');
    }])

    .run(function runApp() {})

    .controller('AppCtrl', function () {});

    return {
      init: function () {
        angular.bootstrap(document, [appName]);
      }
    };
  }
);