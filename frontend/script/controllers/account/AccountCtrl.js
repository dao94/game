// "use strict";

angular.module('app')
    .controller('AccountCtrl', [
        '$scope','$http', '$restful','$modal','growl', 'FileUploader', 'News', '$timeout', function ($scope, $http, $restful, $modal,growl, FileUploader, News, $timeout) {

            $scope.list_account  = [];
            $scope.category      = {};
            
            $scope.loading_state = true;
            $scope.saveLoading   = false;

            $restful.get('account', function(err ,resp) {
                $scope.loading_state = false;
                if(err){
                    growl.warning("Tải dữ liệu thất bại, vui lòng thử lại sau !",{disableCountDown: true});
                }
                $scope.list_account = resp.data;
            });

            $scope.change = function(status, id) {
                var data = {'level' : status, 'id' : id};
                $restful.post('account/changestatus', data, function (err, res) {
                    if(!err) {
                        if(res.error) {
                            growl.warning(res.error_message,{ttl: 4000});
                            return false;
                        } else {
                            growl.success(res.message,{ttl: 4000});
                        }
                    }
                });
            }

            $scope.del = function (item){
                if (!confirm('Bạn muốn xóa chuyên mục này')) {
                    return false;
                };

                $restful.post('account/delete', item, function (err, res) {
                    if(!err) {
                        if(res.error) {
                            growl.warning(res.error_message,{ttl: 4000});
                            return false;
                        } else {
                            growl.success(res.message,{ttl: 4000});
                            $scope.list_account.splice($scope.list_account.indexOf(item), 1);
                        }
                    }
                });
            }

        }
    ])



// "use strict";

angular.module('app')
    .controller('AccountEditCtrl', [
        '$scope','$http', '$restful','$modal','growl', 'FileUploader', 'News', '$timeout', function ($scope, $http, $restful, $modal,growl, FileUploader, News, $timeout) {

            
            $restful.get('account/email-sender', function(err ,resp) {
                $scope.loading_state = false;
                if(err){
                    growl.warning("Tải dữ liệu thất bại, vui lòng thử lại sau !",{disableCountDown: true});
                }
                $scope.frm = resp.data;
            });

            $scope.Save = function(frm) {
                $restful.post('account/update-user', frm, function (err, res) {
                    if(!err) {
                        if(res.error) {
                            growl.warning(res.error_message,{ttl: 4000});
                            return false;
                        } else {
                            growl.success("Thành công",{ttl: 4000});
                        }
                    }
                });
            }

            
        }
    ])