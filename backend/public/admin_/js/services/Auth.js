angular.module('app')
	.service('$auth', [ '$http', '$resource', '$httpProvider', function ( $http, $resource, $httpProvider){
		var local = window.localStorage;
		var $auth = {
			authKey : "__Authorization",
			userKey : "__User",

			setToken: function (token){
				if(!token){
					token = $auth.getToken() ? $auth.getToken() : null;
				}
				local.setItem($auth.authKey, token);
				$http.defaults.headers.common['Authorization'] = token;
				delete $httpProvider.defaults.headers.common['X-Requested-With'];

			},
			getToken: function (){
				return local.getItem($auth.authKey) || "";
			},
			clearToken: function (){
				local.removeItem($auth.authKey);
				delete $http.defaults.headers.common['Authorization'];
			},
			setUser: function (user){
				$auth.setToken(user.token);
				local.setItem($auth.userKey, JSON.stringify(user));
			},
			getUser: function (){
				var user = local.getItem($auth.userKey);
				return JSON.parse(user);
			},
			clearUser: function (){
				$auth.clearToken();
				local.removeItem($auth.userKey);
			}

		};
		return $auth;
	}])