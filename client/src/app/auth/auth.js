define(['angular'], function (angular) {
    'use strict';
    /**
     * @module Login
     */
    angular.module('reviewApp.auth', [])

    /**
     * @module Welcome
     * @class WelcomeCtrl (controller)
     */
    .controller('AuthCtrl', function LoginCtrl($scope, $log) {
        $scope.login = {
          email: '',
          password: ''
        };

        $scope.login = function () {

        }
    });
});