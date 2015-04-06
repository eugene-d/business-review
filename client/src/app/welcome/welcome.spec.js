define(
  [
    'angular-mocks',
    'app',
    'welcome/welcome'
  ],
  function() {
    describe('Welcome Controller', function() {

      beforeEach(module('reviewApp'));

      var $scope;
      beforeEach(inject(function ($rootScope, $controller) {
        $scope = $rootScope.$new();

        $controller('WelcomeCtrl', {$scope: $scope})
      }));

      describe('WelcomeCtrl', function () {
        it('should exists', function () {
          expect($scope).to.be.an('object');
        });

        it('should have message model', function () {
          expect($scope.message).to.equal('Welcome to the Site!');
        });
      });
    });
  }
);
