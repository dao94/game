'use strict';
angular
  .module('app')
  .controller('ProductCtrl', ['$scope', '$restful', '$stateParams', '$http', '$auth', 'growl', 'App', 'FileUploader','Product', 'CONFIG_STATUS', 'Category', 'Provider',
    function ($scope, $restful, $stateParams, $http, $auth, growl, App, FileUploader, Product, CONFIG_STATUS, Category, Provider) {

        $scope.config_status    = CONFIG_STATUS;
        $scope.frm              = {};
        $scope.list_images      = [];
        $scope.feature_image    = [];
        $scope.uploadProcessing = 0;
        $scope.items            = {};
        $scope.list_data        = [];
        $scope.currentPage      = 1;
        $scope.itemsPerPage     = 10;
        $scope.checkLoad        = false;
        $scope.category         = {};
        $scope.provider         = {};
        
        $scope.product_id       = $stateParams.id;        
        $scope.arrLimit         = [10,25,50,100];
        
        $scope.listItemById     = {};

        $scope.loadPage = function () {
            $scope.checkLoad        = true;
            var data = {'limit' : $scope.itemsPerPage, 'page' : $scope.currentPage};
            Product.listProduct(data , function (err, res) {
                $scope.checkLoad        = false;
                if(!err) {
                    if(res.error)
                        return false;
                    $scope.items      = res.data;
                    $scope.totalItems = res.total;
                }
            })
        }

        $scope.loadPage();

        Product.list_category(function(err, res) {
            if(!err)
                $scope.category = res.data;
        });

        Product.list_provider(function(err, res) {
            if(!err)
                $scope.provider = res.data;
        });

        // del items
        $scope.del = function(item) {
            var data = {'id' : item.id};
            Product.delProduct(data, function(err, res) {
                if(!err){
                    $scope.items.splice($scope.items.indexOf(item), 1);
                    growl.success(res.message,{ttl : 4000})
                } else {
                    growl.warning(res.error_message,{ttl : 4000})
                }
            })
        }

        $scope.change = function(status, id) {
            var data = {'status' : status, 'id' : id};
            Product.changeStatus(data, function(err, res) {
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

    	$scope.save = function (frm){
            $scope.checkLoad = true;
            frm.images = $scope.list_images;
            if(!frm.name || !frm.description || !frm.provider_id || !frm.category_id) {
                growl.warning('Lỗi, vui lòng nhập đầy đủ thông tin !', {'ttl' : 5000})
                $scope.checkLoad = false;
                return false;
            }
            Product.add(frm, function (err, res) {
                if(!err) {
                    $scope.checkLoad = false;
                    if(res.error) {
                        growl.warning(res.error_message, {'ttl' : 5000})
                        return false;
                    } else {
                        growl.success(res.message, {'ttl' : 5000})
                        $scope.frm = '';
                    }
                }
            })

    	}

        // edit product

        $scope.listProductById = function() {
            if(!$scope.product_id) 
                return false;
            var data = {'id' : $scope.product_id};
            Product.listProductById(data, function (err, res) {
                if(!err) {
                    if(!res.error) {
                        $scope.listItemById = res.data;
                        $scope.list_images  = $scope.listItemById.images;
                        $scope.listItemById.status = $scope.listItemById.status == 1 ? true : false;
                    }
                }
            })
        }

        $scope.listProductById();

    	$scope.$watch('frm.name', function (newVal){
            $scope.frm.slug = getSlug(newVal);
        })

	}]);

