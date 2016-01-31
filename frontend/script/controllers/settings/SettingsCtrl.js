'use strict';

angular
  .module('app')
    .controller('SettingsCtrl', [
        '$scope','$http', '$restful','$modal','growl', 'FileUploader',   '$interval', '$auth',
            function ($scope, $http, $restful, $modal, growl, FileUploader, $interval, $auth) {

            $scope.data         = {};
            $scope.savedData    = {};

            $http({
                method  : 'GET',
                url     : ApiPath+'settings',
                dataType: 'json'
            }).success(function (result){
                $scope.data = result.data;
            }).error(function (err){
                growl.warning("Lỗi !");
                console.log(err);
            });

            
            $scope.keyPress = function (key, $event){
                $scope.savedData[key] = $scope.data[key];
            }


            /*var uploader_banner = $scope.uploader_banner = new FileUploader({
                url         : ApiPath + 'upload',
                alias       : 'newsFile',
                formData    : [
                    {
                        key : 'request'
                    }
                ],
                headers     :{'X-CSRF-TOKEN' : CSRF_TOKEN }
            });*/

            var uploader_banner = $scope.uploader_banner = new FileUploader({
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


            uploader_banner.filters.push({
                name: 'customFilter',
                fn: function(item, options) {
                    return this.queue.length < 2;
                }
            });

            uploader_banner.onAfterAddingFile = function(fileItem) {
                uploader_banner.uploadAll();
            };

            uploader_banner.onCompleteItem = function(fileItem, response, status, headers) {
                if(!response.error){
                    $scope.data.banner = response.data;
                    $scope.savedData.banner = response.data;
                }
            };



            var uploader_logo = $scope.uploader_logo = new FileUploader({
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


            uploader_logo.filters.push({
                name: 'customFilter',
                fn: function(item, options) {
                    return this.queue.length < 2;
                }
            });

            uploader_logo.onAfterAddingFile = function(fileItem) {
                uploader_logo.uploadAll();
            };

            uploader_logo.onCompleteItem = function(fileItem, response, status, headers) {
                if(!response.error){
                    $scope.data.logo = response.data;
                    $scope.savedData.logo = response.data;
                }
            };

            $scope.saveProcessing = false;
            $scope.postSave = function (){
                $scope.saveProcessing = true;
                $http({
                    method   : 'POST',
                    url      : ApiPath+'settings/save',
                    data     : $scope.savedData,
                    dataType : 'json'
                }).success(function (result){
                    $scope.saveProcessing = false;
                    if(!result.error){
                        growl.success("Cập nhật thành công");
                    }else {
                        growl.warning("Cập nhật thất bại");
                    }
                }).error(function (err){
                    growl.warning("Cập nhật thất bại");
                });
            }
    }])