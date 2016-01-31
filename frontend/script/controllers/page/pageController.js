  'use strict';
angular
  .module('app')
  .controller('pageController', ['$scope', '$restful', '$stateParams', '$http', '$auth', 'growl', '$state',
    function ($scope, $restful, $stateParams, $http, $auth, growl, $state) {

        $scope.items     = {};
        $scope.checkLoad = false;
        $scope.intro     = {};

        $restful.get('page',function(err, res) {
            $scope.checkLoad = false;
            if(!err) {
                $scope.items = res.data;
            }
        })

        var id = $stateParams.id;

        $scope.getListByid = function() {
            if(!id)
                return false;
            var data = {'id' : id};
            $restful.get('page/byid', data, function(err, res) {
                if(!err) {
                    $scope.intro        = res.data;
                    $scope.intro.status = res.data.status == 1 ? true : false;
                }
            })
        }

        $scope.getListByid();

        $scope.add = function (data) {
            $restful.post('page/add', data, function(err, res) {
                if(!err) {
                    if(res.error) {
                        growl.warning(res.error_message, {ttl : 4000})
                    } else {
                        growl.success(res.message, {ttl:4000});
                        $state.go('app.page');
                    }
                } else {
                    growl.warning('Lỗi kết nối mạng, vui lòng thử lại !',{ttl : 4000})
                }
            });
        }

        $scope.change = function(status, id) {
            var data         = {'status' : status, 'id' : id};
            $restful.post('page/change', data, function(err, res) {
                if(err) {
                    growl.warning('lỗi kết nối mạng, vui lòng thử lại !',{ttl : 4000})
                    return false;
                }
                if(!res.error){
                    growl.success(res.message,{ttl : 4000})
                } else {
                    growl.warning(res.error_message,{ttl : 4000})
                }
            })
        }

        $scope.update = function (intro) {
            $restful.post('page/update', intro, function(err, res) {
                if(!err) {
                    if(res.error) {
                        growl.warning(res.error_message, {ttl : 4000})
                    } else {
                        growl.success(res.message, {ttl:4000});
                        $state.go('app.page');
                    }
                } else {
                    growl.warning('Lỗi kết nối mạng, vui lòng thử lại !',{ttl : 4000})
                }
            });
        }

        $scope.del = function(item) {
            var data = {'id' : item.id};
            $restful.post('page/delete', data, function(err, res) {
                if(!err) {
                    if(res.error) {
                        growl.warning(res.error_message, {ttl : 4000})
                    } else {
                        growl.success(res.message, {ttl:4000});
                        $scope.items.splice($scope.items.indexOf(item), 1);
                    }
                } else {
                    growl.warning('Lỗi kết nối mạng, vui lòng thử lại !',{ttl : 4000})
                }
            });
        }
       
    }]);



