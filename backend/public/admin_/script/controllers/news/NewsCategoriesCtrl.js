// "use strict";

angular.module('app')
    .controller('NewsCategoriesCtrl', [
        '$scope','$http', '$restful','$modal','growl', 'FileUploader', 'News', '$timeout', function ($scope, $http, $restful, $modal,growl, FileUploader, News, $timeout) {
        	$scope.list_categories = [];
        	$scope.category = {};

        	$scope.loading_state = true;
            $scope.saveLoading   = false;

            News.listCategory(function (err, resp){
            	$scope.loading_state = false;
            	if(err){
            		growl.warning("Tải dữ liệu thất bại, vui lòng thử lại sau !",{disableCountDown: true});
            	}

            	$scope.list_categories = resp.data;
            });

            $scope.$watch('category.name', function (newVal){
            	$scope.category.slug = getSlug(newVal);
            })

            $scope.selectCategory = function (category){
                $scope.category = category;
            }


            $scope.save = function (category){
                var action = News.saveCategory;

                if(category.id && category.id > 0){
                    action = News.editCategory;  
                }

                function callback (err, resp){
                    $scope.saveLoading   = false;
                    if(resp.error){
                        growl.warning(resp.error_message, {disableCountDown: false});
                        return;
                    }
                    if(angular.isObject(resp.data)){
                        $scope.list_categories.push(resp.data);
                    }

                    growl.success("Thành công", {disableCountDown: false});
                }
                $scope.saveLoading   = true;
            	action.apply(this, [category, callback]);
            }

            $scope.remove = function (item){
                if (!confirm('Bạn muốn xóa chuyên mục này')) {
                    return false;
                };

                News.removeCategory({id: item.id}, function (err, resp){
                    if(!err){
                        
                        $timeout(function (){
                            growl.success("Thành công", {disableCountDown: false});
                            $scope.list_categories.splice($scope.list_categories.indexOf(item), 1);
                        }, 0)
                        
                        
                    }
                })
            }

        }
    ])