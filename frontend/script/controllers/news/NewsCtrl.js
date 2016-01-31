// "use strict";

angular.module('app')
    .controller('NewsCtrl', [
        '$scope','$http', '$restful','$modal','growl', 'FileUploader', 'News',  function ($scope, $http, $restful, $modal,growl, FileUploader, News) {
            $scope.list_data    = [];
            $scope.currentPage  = 1;
            $scope.itemsPerPage = 10; 
            $scope.pageLoading  = true;
            
            

            
        	$scope.loadPage = function (stt){
                var stt = stt || "";

                var data = {
                    limit: $scope.itemsPerPage,
                    page: $scope.currentPage,
                    stt: stt
                };
                $scope.pageLoading = true;
                News.loadNews(data, function (error, resp){
                    $scope.pageLoading = false;
                    if(error){
                        growl.warning("Tải dữ liệu thất bại, vui lòng thử lại sau !",{disableCountDown: false});
                        return;
                    };
                    $scope.list_data  = resp.data;
                    $scope.totalItems = resp.total;
                    $scope.maxSize    = 5;
                })
        	}

            $scope.removeProcess = false;
            $scope.remove = function (item){
                if (!confirm('Bạn muốn xóa tin này')) {
                    return false;
                };

                $scope.removeProcess = true;
                News.removeNews({id: item.id}, function (err, resp){
                    $scope.removeProcess = false;
                    if(!err){
                        growl.success("Thành công", {disableCountDown: false});
                        $scope.list_data.splice($scope.list_data.indexOf(item), 1);
                    }
                })
            }

        	$scope.loadPage();
    }]);
angular.module('app')
    .controller('NewsSaveCtrl', ['$scope', '$state', '$stateParams', '$timeout', '$restful', '$http', '$auth', 'growl', 'App', 'FileUploader', 'News',
        function ($scope, $state, $stateParams, $timeout, $restful, $http, $auth, growl, App, FileUploader, News) {
            $scope.frm = {
                images: ""
            };
            
            if($stateParams.id && $stateParams.id > 0){
                News.getNews($stateParams.id, function (err, resp){
                    $scope.frm = resp.data;
                })
            }

            $scope.list_images = [];
            $scope.uploadProcessing = 0;

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
                $scope.uploadProcessing = 0;
                //console.log(addedItems);
                $scope.uploader.uploadAll();
            };


            $scope.uploader.onProgressAll = function (process){
                $scope.uploadProcessing = process;
            }
            $scope.uploader.onCompleteItem = function (item, response, status, headers){
                if(!response.error){
                        $scope.setFeatureImage(response.data);
                }
            }
            $scope.uploader.onCompleteAll = function (){
                $scope.uploadProcessing = 0;
            }


            $scope.setFeatureImage = function (image){
                $scope.frm.images = image;
            }

            $scope.save = function (frm){
                var action = News.saveNews;

                if(frm.id && frm.id > 0){
                    action = News.editNews;  
                }

                function callback(err, response){
                    $scope.saveLoading   = false;
                    if(err){
                        growl.warning(response.error_message);
                        return;
                    }

                    growl.success("Thành công");
                    $state.go('app.news');
                }

                $scope.saveLoading   = true;
                action.apply(this, [frm, callback]);
            }

            News.listCategory(function (err, resp){
                if(err){
                    growl.warning(err,{ttl : 1000});
                    return;
                }
                $scope.list_category = resp.data;
            });

            $scope.$watch('frm.name', function (newVal){
                $scope.frm.slug = getSlug(newVal);
            })

        }]);