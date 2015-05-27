define(['angular'], function (angular) {
    'use strict';

    angular.module('reviewApp.branch-resource', ['ngResource'])
      .factory('BranchResource', ['$resource', function ($resource) {
        return $resource('/api/v1/branch/', null, {'delete': {method: 'DELETE', url: '/api/v1/branch/delete'}});
      }]);
  }
);