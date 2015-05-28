define(['angular'], function (angular) {
    'use strict';
    /**
     * @module Login
     */
    angular.module('reviewApp.userMenu', [])

    /**
     * @module Welcome
     * @class WelcomeCtrl (controller)
     */
    .controller('UserMenuCtrl', function LoginCtrl($scope, $mdSidenav, $mdUtil, $log) {
        $scope.showLogin = buildToggler('left');

        /**
         * Build handler to open/close a SideNav; when animation finishes
         * report completion in console
         */
        function buildToggler(navID) {
          var debounceFn =  $mdUtil.debounce(function(){
            $mdSidenav(navID)
              .toggle()
              .then(function () {
                $log.debug("toggle " + navID + " is done");
              });
          }, 300);
          return debounceFn;
        }
      });
});