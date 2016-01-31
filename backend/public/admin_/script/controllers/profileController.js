'use strict';
angular
  .module('app')
  .controller('profileController', ['$scope', '$state', '$stateParams', '$timeout', '$restful', '$http', '$auth','growl',
    function ($scope, $state, $stateParams, $timeout, $restful, $http, $auth,growl) {
        $scope.citys    = {};
        $scope.district = {};

        $scope.update = function(user) {

            if($scope.user.date != undefined && $scope.user.date != ''){
                user.date  = Date.parse($scope.user.date)/1000;
            }

            $restful.post('profile/update',user,function (err,res) {
                if(!err) {
                    console.log(res);
                }
            });

        }

        $scope.listCity = function() {
            $restful.get('profile/listcity',function (err,res) {
                if(!err) {
                    $scope.citys =  res.data;
                }
            });            
        }

        $scope.selectcity = function() {
            var cityId = $scope.user.city.id;
            var data   = {'cityId':cityId};
            $restful.get('profile/listdistrict',data,function (err,res) {
                if(!err) {
                    $scope.district = res.data;
                }
            });   
        }

        $scope.listCity();

    }]);

