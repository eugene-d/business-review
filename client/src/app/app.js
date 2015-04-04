define(
  [
    'angular',
    'angular-route',
    'app/welcome/welcome'
  ],
  function(angular) {
    'use strict';

    var appName = 'reviewApp';

    var app = angular.module(appName, ['ngRoute']);

    app.init = function () {
      angular.bootstrap(document, [appName])
    };

    app.config(['$routeProvider', function appConfig($urlRouteProvider) {
      $urlRouteProvider.otherwise('/welcome');
    }]);

    app.run([function runApp() {
    }]);

    app.controller('AppCtrl', function () {
      // do nothing
    });

    return app;
  }
);