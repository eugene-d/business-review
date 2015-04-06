define( [
    'angular',
    'angular-route',
    'angular-animate',
    'angular-aria',
    'angular-material',
    'uiRouter',
    'welcome/welcome',
    'service/name-service'
  ],
  function(angular) {
    'use strict';

    var appName = 'reviewApp';

    angular.module(appName, ['ngRoute', 'reviewApp.welcome', 'reviewApp.name-service'])

    .config(['$routeProvider', function appConfig($urlRouteProvider) {
      $urlRouteProvider.otherwise('/welcome');
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