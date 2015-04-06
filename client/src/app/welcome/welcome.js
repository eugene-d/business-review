define(['angular'], function(angular) {
    'use strict';

    /**
     * @module Welcome
     */
  angular.module('reviewApp.welcome', ['ui.router', 'ngMaterial'])

    /**
     * @module Welcome
     * @class Route
     */
    .config(['$stateProvider', function config($stateProvider) {
      $stateProvider.state('welcome', {
        url: '/welcome',
        views: {
          main: {
            controller: 'WelcomeCtrl',
            templateUrl: 'app/welcome/welcome.tpl.html'
          }
        }
      });
    }])

    /**
     * @module Welcome
     * @class WelcomeCtrl (controller)
     */
    .controller('WelcomeCtrl', function WelcomeCtrl($scope) {
        $scope.message = 'Welcome to the Site!';
    });
  }
);