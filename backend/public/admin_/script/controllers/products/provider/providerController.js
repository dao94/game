'use strict';
angular
  .module('app')
  .controller('providerController', ['$scope', '$restful', 'growl', 'Provider', function ($scope, $restful, growl, Provider) {

        $scope.checkLoad     = false;
        $scope.checkLoadForm = false;
        $scope.checkSubmit   = false;
        $scope.checkf        = true;
        $scope.items         = ''; 
        $scope.itemId        = '';

        $scope._load = function() {
          Provider.listCategory(function (err, res) {
            if(!err) {
              $scope.checkLoad     = true;
              $scope.checkLoadForm = true;                
              $scope.items         = res.data;
            }
          });
        }

        $scope._load();

        $scope.$on('change_', function (evt,params){
          $scope.save(params);
        });

        $scope.add =  function(data) {
          $scope.checkSubmit   = true;
          if(data && data.name != '') {
            Provider.addCategory(data, function (err, res) {
              $scope.checkSubmit = false;
              $scope.category    = '';
              if(!err) {
                if(!res.error) {
                  $scope._load();
                  growl.success(res.message,{ttl : 4000});
                }
                else
                  growl.warning(res.error_message,{ttl : 4000});
              }
            });
          } else {
            growl.warning('Vui lòng nhập tên danh mục',{ttl : 4000});
            $scope.checkSubmit   = false;
            return false;
          }
          
        };

        $scope.save = function(data) {
          $scope.checkf = false;
          Provider.saveCategory(data, function (err, res) {
            if(!err) {
              Provider.listByid($scope.itemId, function(err, res) {
                $scope.checkf          = true;
                $scope.category        = res.data;
                $scope.category.active = res.data.active == 1 ? true : false;
              });
            }
          });
        }

        $scope.func = function (item) {
          $scope.itemId = item.id;
        }

        $scope.del = function() {
          $scope.checkSubmit   = true;
          Provider.delById($scope.itemId, function(err, res) {
            $scope.checkSubmit   = false;
            if(!err) {
              if(res.error)
                growl.warning(res.error_message, {ttl : 4000});
              growl.success(res.message, {ttl : 4000})
            }
          });
        }

	}]);

