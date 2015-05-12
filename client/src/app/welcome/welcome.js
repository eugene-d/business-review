define(['angular'], function (angular) {
    'use strict';

    /**
     * @module Welcome
     */
    angular.module('reviewApp.welcome', ['ui.router'])

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
      .controller('WelcomeCtrl', function WelcomeCtrl($scope, BranchResource) {
        $scope.message = 'Welcome to the Site!';
        $scope.branches = [];
        $scope.deleteBranch = function (branchId, branchIndex) {
          BranchResource.delete({id: branchId}, function (response) {
            if (response.status && response.status === 200) {
              $scope.branches.splice(branchIndex, 1);
            }
          });
        };

        var init = function () {
          BranchResource.get({}, function (responce) {
            if (responce.branches) {
              $scope.branches = responce.branches;
            }
          });
        };

        init();
      });
  }
);