'use strict';
angular
  .module('app')
  .controller('CollectionCtrl', ['$scope', '$state', '$stateParams', '$timeout', '$restful', '$http', '$auth', 'growl',
    function ($scope, $state, $stateParams, $timeout, $restful, $http, $auth, growl) {
    	console.log('CollectionCtrl');
	}]);

