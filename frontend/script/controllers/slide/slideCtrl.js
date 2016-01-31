'use strict';
angular
  .module('app')
  .controller('slideCtrl', ['$scope', '$state', '$stateParams', '$timeout', '$restful', '$http', '$auth','growl', 'FileUploader',
    function ($scope, $state, $stateParams, $timeout, $restful, $http, $auth,growl, FileUploader) {

        $scope.arrLimit     = [10,25,50,100];
        $scope.itemsPerPage = 10;
        $scope.items        = [];
        $scope.currentPage  = 1;
        $scope.itemById     = {};

        $scope.listSlide    = function () {
            var data = {'limit' : $scope.itemsPerPage, 'page' : $scope.currentPage};
            $restful.get('slide', data, function(err, res) {
                if(err)
                    return false;
                $scope.items      = res.data;
                $scope.totalItems = res.total;
            })
        }

        $scope.listSlide();

        $scope.change = function(status, id) {
            var data = {'id' : id, 'status' : status};
            $restful.post('slide/changestatus', data, function(err, res) {
                if(err) 
                    return false;
                if(res.error) {
                    growl.warning(res.error_message,{ttl : 5000});
                    return false;
                } else {
                    growl.success(res.message,{ttl : 5000});
                }
            })
        }

        $scope.del = function(data) {
            $restful.post('slide/delete', data, function(err, res) {
                if(err) 
                    return false;
                if(res.error) {
                    growl.warning(res.error_message,{ttl : 5000});
                    return false;
                } else {
                    $scope.items.splice($scope.items.indexOf(data), 1);
                    growl.success(res.message,{ttl : 5000});
                }
            })   
        }

        $scope.uploader = new FileUploader({
            url: ApiPath + 'uploader',
            alias: 'file',
            queueLimit: 5,
            headers: {
                Authorization: $auth.getToken()
            },
            formData: [
                {
                    key: 'request'
                }
            ]
        });

        $scope.uploader.onAfterAddingAll  = function (addedItems){
            $scope.list_images      = [];
            $scope.uploadProcessing = 0;
            $scope.uploader.uploadAll();
        };


        $scope.uploader.onProgressAll = function (process){
            $scope.uploadProcessing = process;
        }

        $scope.uploader.onCompleteItem = function (item, response, status, headers){
            if(!response.error){
                if($scope.list_images.length == 0){
                    $scope.setFeatureImage(response.data);
                }
                $scope.list_images.push(response.data);
            }
        }

        $scope.uploader.onCompleteAll = function (){
            $scope.uploadProcessing = 0;
        }

        $scope.setFeatureImage = function (image){
            $scope.feature_image = image;
        }

        $scope.add = function() {
            var data = {'name' : $scope.name , "alt" : $scope.alt , 'images' : $scope.feature_image};
            $restful.post('slide/add', data, function(err, res) {
                if(!err) {
                    if(!res.error) {
                        growl.success(res.message, {ttl: 5000});
                        $scope.items.push(res.data);
                        $('.create_slide').modal('hide');
                        $scope.restartForm();
                    } else {
                        growl.warning(res.error_message,{ttl : 5000});
                    }
                }
            });
        }

        $scope.restartForm = function() {
            $scope.name          = '';
            $scope.alt           = '';
            $scope.feature_image = '';
        }

        $scope.update = function(item) {
            var data = {'id' : item.id};
            $restful.get('slide/byid', data, function(err, res) {
                if(!err) {
                    $scope.itemById      = res.data;
                    $scope.feature_image = res.data.images;
                }
            });
        }

        $scope.save = function(item) {
            var data = {'id' : item.id , 'name' : item.name , 'alt' : item.alt, 'images' : $scope.feature_image};
            $restful.post('slide/update', data, function(err, res) {
                if(!err) {
                    if(!res.error) {
                        growl.success(res.message, {ttl: 5000});
                        $('.update_slide').modal('hide');
                        $scope.restartForm();
                        $scope.listSlide();
                    } else {
                        growl.warning(res.error_message,{ttl : 5000});
                    }
                }
            });   
        }

	}]);

