
app.directive('widgetSlideAdd', ['$restful', function($restful) {
    return {
        restrict: 'A',
        templateUrl: 'tpl/widgets/create_slide.html',
        link : function ($scope) {
			$scope.listUser      = [];
			$scope.close = function () {
	            $('.create_slide').modal('hide');   
	        }
        }
    }
}]);

app.directive('widgetSlideUpdate', ['$restful', function($restful) {
    return {
        restrict: 'A',
        templateUrl: 'tpl/widgets/update_slide.html',
        link : function ($scope) {
            $scope.listUser      = [];
            $scope.close = function () {
                $('.update_slide').modal('hide');   
            }
        }
    }
}]);