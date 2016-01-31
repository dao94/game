'use strict';

/**
 * Config for the router
 */
angular.module('app')
  .run(['$rootScope', '$state', '$stateParams','$auth',
      function ($rootScope, $state, $stateParams, $auth) {
          $rootScope.$state       = $state;
          $rootScope.$stateParams = $stateParams;     
          $rootScope.user         = $auth.getUser() || false;   
          $rootScope.MediaPath    = MediaPath;

          $rootScope.$on('$stateChangeSuccess', function (ev, data, bcb) {
            window.scrollTo(0, 0);
          });

          $rootScope.$on('$stateChangeStart', function (ev, toState, toParams){
            $rootScope.user = $auth.getUser() || false;

            if(toState.name.indexOf('app') !== -1){
              if(!$auth.getUser() || $auth.getUser()['token']['exp']  <= (Date.now() / 1000) && !$auth.getToken()){
                  $auth.clearUser();
                  $rootScope.user = $auth.getUser() || false;
                  ev.preventDefault();
                  window.location = 'http://webgame.local/#/access/login';
                  return ;
              }
            }

            if(toState.name == 'access.login') {
              $auth.clearUser();
              $rootScope.user = $auth.getUser() || false;
            }

            $rootScope.logout = function() {
              $auth.clearUser();
              $rootScope.user = '';
              $state.go('access.login');
            }
          });

          $auth.setToken();
      }
  ])
  .config(
    [          '$stateProvider', '$urlRouterProvider', 'JQ_CONFIG', 'MODULE_CONFIG', 
      function ($stateProvider,   $urlRouterProvider, JQ_CONFIG, MODULE_CONFIG) {
          $urlRouterProvider
              .otherwise('/app/dashboard');
          
          $stateProvider
              .state('app', {
                  abstract: true,
                  url: '/app',
                  templateUrl: "tpl/app.html"
              })

              .state('app.dashboard', {
                  url: '/dashboard',
                  templateUrl: 'tpl/app_dashboard.html',
                  resolve: load( ['script/controllers/dashboardController.js'] )
              })

              .state('app.profile', {
                  url: '/profile',
                  templateUrl: 'tpl/page_profile.html',
                  resolve:load(['script/controllers/profileController.js'])
              })

              .state('app.page', {
                  url: '/trang',
                  templateUrl: 'tpl/page/index.html',
                  resolve:load(['script/controllers/page/pageController.js'])
              })

              .state('app.page_create', {
                  url: '/trang/tao-moi',
                  templateUrl: 'tpl/page/create.html',
                  resolve:load(['script/controllers/page/pageController.js'])
              })

              .state('app.page_update', {
                  url: '/trang/cap-nhat/:id',
                  templateUrl: 'tpl/page/update.html',
                  resolve: load( ['script/controllers/page/pageController.js'] )
              })

              .state('app.collection', {
                  url: '/collections',
                  templateUrl: 'tpl/collections/index.html',
                  resolve: load( ['script/controllers/collections/CollectionCtrl.js'] )
              })

              .state('app.news', {
                  url: '/tin-tuc',
                  templateUrl: 'tpl/news/index.html',
                  resolve: load( ['script/controllers/news/NewsCtrl.js'] )
              })

              .state('app.news_create', {
                  url: '/tin-tuc/tao-moi',
                  templateUrl: 'tpl/news/save.html',
                  resolve: load( ['script/controllers/news/NewsCtrl.js'] )
              })

              .state('app.news_edit', {
                  url: '/tin-tuc/:slug/:id',
                  templateUrl: 'tpl/news/save.html',
                  resolve: load( ['script/controllers/news/NewsCtrl.js'] )
              })


              .state('app.news_categories', {
                  url: '/tin-tuc/chuyen-muc',
                  templateUrl: 'tpl/news/categories.html',
                  resolve: load( ['script/controllers/news/NewsCategoriesCtrl.js'] )
              })

              .state('app.slide', {
                  url: '/slide',
                  templateUrl: 'tpl/slide/index.html',
                  resolve: load( ['script/controllers/slide/slideCtrl.js'] )
              })

              .state('app.settings', {
                  url: '/cau-hinh',
                  templateUrl: 'tpl/settings/index.html',
                  resolve: load( ['script/controllers/settings/SettingsCtrl.js'] )
              })

              .state('app.account', {
                  url: '/tai-khoan',
                  templateUrl: 'tpl/account/index.html',
                  resolve: load( ['script/controllers/account/AccountCtrl.js'] )
              })
              .state('app.account_edit', {
                  url: '/cap-nhat-tai-khoan',
                  templateUrl: 'tpl/account/edit.html',
                  resolve: load( ['script/controllers/account/AccountCtrl.js'] )
              })


              // others
              .state('access', {
                  url: '/access',
                  templateUrl: 'tpl/login/index.html',
              })
              .state('access.login', {
                  url: '/login',
                  templateUrl: 'tpl/login/page_signin.html',
                  resolve: load( ['js/controllers/signin.js'] )
              })
              .state('access.register', {
                  url: '/register',
                  templateUrl: 'tpl/login/page_signup.html',
                  resolve: load( ['script/controllers/loginController.js'] )
              })
              .state('access.forgotpwd', {
                  url: '/forgotpwd',
                  templateUrl: 'tpl/login/page_forgotpwd.html'
              })
              .state('access.404', {
                  url: '/404',
                  templateUrl: 'tpl/login/page_404.html'
              })


          function load(srcs, callback) {
            return {
                deps: ['$ocLazyLoad', '$q',
                  function( $ocLazyLoad, $q ){
                    var deferred = $q.defer();
                    var promise  = false;
                    srcs = angular.isArray(srcs) ? srcs : srcs.split(/\s+/);
                    if(!promise){
                      promise = deferred.promise;
                    }
                    angular.forEach(srcs, function(src) {
                      promise = promise.then( function(){
                        if(JQ_CONFIG[src]){
                          return $ocLazyLoad.load(JQ_CONFIG[src]);
                        }
                        angular.forEach(MODULE_CONFIG, function(module) {
                          if( module.name == src){
                            name = module.name;
                          }else{
                            name = src;
                          }
                        });
                        return $ocLazyLoad.load(name);
                      } );
                    });
                    deferred.resolve();
                    return callback ? promise.then(function(){ return callback(); }) : promise;
                }]
            }
          }


      }
    ]
  );
