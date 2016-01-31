// config

var app =  
angular.module('app')
  .config(
    [        '$controllerProvider', '$compileProvider', '$filterProvider', '$provide', '$nestableProvider',
    function ($controllerProvider,   $compileProvider,   $filterProvider,   $provide , $nestableProvider) {
          
        // lazy controller, directive and service
        $nestableProvider.defaultOptions({maxDepth : 2}) 
        app.controller = $controllerProvider.register;
        app.directive  = $compileProvider.directive;
        app.filter     = $filterProvider.register;
        app.factory    = $provide.factory;
        app.service    = $provide.service;
        app.constant   = $provide.constant;
        app.value      = $provide.value;
    }
  ])
  .config(function ($provide) {
    $provide.decorator('taOptions', ['taRegisterTool', '$delegate', '$modal', function (taRegisterTool, taOptions, $modal) {
        taRegisterTool('uploadImage', {
            buttontext: "Upload Image",
            iconclass: "fa fa-image",
            action: function (deferred, restoreSelection) {
                $modal.open({
                    controller: function($scope, $modalInstance, FileUploader, $auth){

                        $scope.image = '';
                        $scope.progress = 0;
                        $scope.files = [];

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
                            
                        };


                        $scope.uploader.onProgressAll = function (process){
                            $scope.uploadProcessing = process;
                        }
                        $scope.uploader.onCompleteItem = function (item, response, status, headers){
                            if(!response.error){
                                    $scope.image = MediaPath + response.data;
                            }
                        }
                        $scope.uploader.onCompleteAll = function (){
                            $scope.uploadProcessing = 0;
                        }


                        $scope.upload = function(){
                            $scope.uploader.uploadAll();
                        };

                        $scope.insert = function(){
                            $modalInstance.close($scope.image);
                        };

                    },
                    templateUrl: 'tpl/modals_upload.html'
                }).result.then(
                    function (result) {
                        console.log(restoreSelection(), result.toString())
                        
                        document.execCommand('insertImage', true, result.toString());
                        deferred.resolve();
                    },
                    function () {
                        deferred.resolve();
                    }
                );
                return false;
            }
        });
        taOptions.toolbar[1].push('uploadImage');
        return taOptions;
    }]);
  })


  .config(['$translateProvider', function($translateProvider){
    // Register a loader for the static files
    // So, the module will search missing translation tables under the specified urls.
    // Those urls are [prefix][langKey][suffix].
    $translateProvider.useStaticFilesLoader({
      prefix: 'l10n/',
      suffix: '.js'
    });
    // Tell the module what language to use by default
    $translateProvider.preferredLanguage('en');
    // Tell the module to store the language in the local storage
    $translateProvider.useLocalStorage();
  }]);