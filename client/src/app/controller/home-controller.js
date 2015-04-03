define(
  [
    'angular',
    'app/service/name-service',
    'app/directive/name-directive'
  ],
  function(angular) {
    'use strict';

    angular
      .module('ng-boilerplate.home-controller', [
        'ng-boilerplate.name-service',
        'ng-boilerplate.name-directive'
      ])
      .controller('HomeController', [
        '$scope',
        'NameService',
        function($scope, NameService) {
          $scope.nameService = NameService;
        }
      ]);

  }
);