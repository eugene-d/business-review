define(
  [
    'angular',
    'angular-route',
    'app/controller/home-controller'
  ],
  function(angular) {
    'use strict';

    angular
      .module('ng-boilerplate', ['ngRoute', 'ng-boilerplate.home-controller'])
      .config([
        '$routeProvider',
        '$sceProvider',
        '$locationProvider',
        function($routeProvider, $sceProvider, $locationProvider) { // jshint ignore:line
          $routeProvider
            .when('/', {
              controller: 'HomeController',
              templateUrl: 'app/controller/home.tpl.html'
            })
            .otherwise({ redirectTo: '/' });

          // Disables Strict Contextual Escaping for IE8 compatibility
          $sceProvider.enabled(false);

//          // Commented out for use on GitHub Pages
//          // Only use html5Mode for modern browsers
//          if (window.history && history.pushState) {
//            $locationProvider.html5Mode(true);
//          }
        }
      ]);
  }
);