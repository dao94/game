'use strict';

 var ApiPath   = 'http://localhost:8000/api/v1/';
 var MediaPath = 'http://localhost:8000/uploads/';

angular.module('app', [
    'ngAnimate',
    'ngAria',
    'ngCookies',
    'ngMessages',
    'ngResource',
    'ngSanitize',
    'ngTouch',
    'ngStorage',
    'ui.router',
    'ui.bootstrap',
    'ui.utils',
    'ui.load',
    'ui.jq',
    'oc.lazyLoad',
    'pascalprecht.translate',
    'ngMaterial',
    'angular-growl',
    'angularFileUpload',
    'ng-nestable',
    'textAngular'
])



.directive('formatnumber', function() {
  return {
    require: 'ngModel',
    link: function(scope, element, attrs, modelCtrl) {
      modelCtrl.$parsers.push(function(data) {
        if(data != '' && data != undefined){
            //convert data from view format to model format
            var string  = data.toString().replace(/^(0*)/,"");
            string      = string.replace(/(\D)/g,"");
            string      = string.replace(/^$/,"0");
            string      = string.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
            
             if (string!=data) {
               modelCtrl.$setViewValue(string);
               modelCtrl.$render();
             }   
                      
            return string; //converted
        }
        return;
      });
    }
  }
});
