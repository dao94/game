'use strict';
angular
  .module('app')
  .controller('DealPricingCtrl', ['$scope', '$state', '$stateParams', '$timeout', '$restful', '$http', '$auth', 'growl', 'Product',
    function ($scope, $state, $stateParams, $timeout, $restful, $http, $auth, growl, Product) {
    	$scope.list_current = [{}];
    	$scope.list_product = [];
        $scope.stateParams = $stateParams;

        if($stateParams.id  && $stateParams.id){
            $restful.get('deal-pricing/index/' + $stateParams.id, function (err, resp){
                $scope.frm = resp.data;
                $scope.list_product = resp.data.items;
            })
        }
        function get_number(data){
            if(data != undefined && data != ''){
                if(typeof data == 'string'){
                    return data.toString().replace(/,/gi,"");
                }else {
                    return data.toString();
                }
            }
            return 0;   
        }
        function formart_number(data){
            var string  = data.toString().replace(/^(0*)/,"");
            string      = string.replace(/(\D)/g,"");
            string      = string.replace(/^$/,"0");
            string      = string.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
            return string;
        }

    	$scope.addCurrentItem = function (){
    		$scope.list_current.push({});
    	}
    	$scope.save = function (lists, frm){
            if(frm.to_company == "" || frm.to_name == "" || frm.to_email == ""){
                return alert('Vui lòng kiểm tra thông tin khách hàng');
            }

            if(frm.length == 0 ){
                return alert('Vui lòng nhập sản phẩm báo giá');
            }

			$restful.post('deal-pricing/save', {item: lists, info: frm}, function (err, resp){
                if(!err){
                    $state.go('app.deal_pricing_list');
                }else {
                    return alert(err);
                }
			})
    	}




    	$scope.suggestProduct = function (value){
			return $http.get(ApiPath+ 'products/suggest', {params: {query: value}}).then(function (resp){
				return resp.data.data;
			})
    	}
        $scope.onsuggestProductSelected = function ($item, $model, current){
            if($item){
                current.price        = $item.price;
                current.unit         = "1";
                current.quantity     = 1;
                current.description  = $item.description;
                current.product_name = $item.name;
                current.product_id   = $item.id;
                
                $scope.updateField('all', current);
            }
        }
        $scope.updateField = function (field, current){

            if(parseInt(get_number(current.price)) > 0 && parseInt(current.quantity) > 0){
                current.total_price = formart_number(parseInt(get_number(current.price)) *  parseInt(current.quantity));
            }
        }

	}]);


angular
  .module('app')
  .controller('DealCtrl', ['$scope', '$state', '$stateParams', '$timeout', '$restful', '$http', '$auth', 'growl', 'Product',
    function ($scope, $state, $stateParams, $timeout, $restful, $http, $auth, growl, Product) {
        $scope.list_current = [{}];
        $scope.list_product = [];

        $scope.currentPage      = 1;
        $scope.itemsPerPage     = 10;
        $scope.totalItems       = 0;
       
        function get_number(data){
            if(data != undefined && data != ''){
                if(typeof data == 'string'){
                    return data.toString().replace(/,/gi,"");
                }else {
                    return data.toString();
                }
            }
            return 0;   
        }
        function formart_number(data){
            var string  = data.toString().replace(/^(0*)/,"");
            string      = string.replace(/(\D)/g,"");
            string      = string.replace(/^$/,"0");
            string      = string.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
            return string;
        }

        $scope.pageLoading = true;
        $scope.load= function (){
            $scope.pageLoading = true;

            var data = {'limit' : $scope.itemsPerPage, 'page' : $scope.currentPage};
            
            $restful.get('deal-pricing', data,  function (err, resp){
                $scope.pageLoading  = false;
                $scope.list_data    = resp.data;
            })
        };
        $scope.acceptLoading = false;
        $scope.accept = function (item){
            $scope.acceptLoading = true;
            $restful.post('deal-pricing/accept', {id: item.id}, function (err, resp){
                $scope.acceptLoading = false;
                if(err){
                    return alert('Lỗi truy vấn, vui lòng thử lại sau !');
                }
                growl.success('Thành công');
                item.time_accept = Date.now() / 1000;

            })
            
        }

        $scope.removeProcess = false;
        $scope.remove = function (item){
            if(!confirm("Bạn muốn xóa bản báo giá này ?")){
                return false;
            }

            $scope.removeProcess = true;
            $restful.post('deal-pricing/remove', {id: item.id}, function (err, resp){
                $scope.removeProcess = false;
                if(err){
                    return alert('Lỗi truy vấ, nvui lòng thử lại sau !');
                }
                growl.success('Thành công');

                $scope.list_data.splice($scope.list_data.indexOf(item), 1);
                item.time_accept = Date.now() / 1000;

            })
        }





        $scope.load();
        
        

    }]);

