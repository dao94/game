angular.module('app')
	.service('News', ['$resource', '$restful', function ($resource, $restful){
		
		var News = {
			
			listCategory : function (callback){
				$restful.get('news-category', function (error, resp){
					callback(error, resp)
				});
			},

			saveCategory : function (params, callback){
				$restful.post('news-category/save', params, function (error, resp){
					callback(error, resp)
				});
			},

			editCategory : function (params, callback){
				$restful.post('news-category/edit', params, function (error, resp){
					callback(error, resp)
				});
			},

			removeCategory : function (params, callback){
				$restful.post('news-category/delete', params, function (error, resp){
					callback(error, resp)
				});
			},

			loadNews : function (params, callback){
				$restful.get('news', params, function (error, resp){
					callback(error, resp)
				});
			},
			getNews : function (id, callback){
				$restful.get('news/show/' + id,  function (error, resp){
					callback(error, resp)
				});
			},

			saveNews : function (params, callback){
				$restful.post('news/save', params, function (error, resp){
					callback(error, resp)
				});
			},

			editNews : function (params, callback){
				$restful.post('news/edit', params, function (error, resp){
					callback(error, resp)
				});
			},
			removeNews : function (params, callback){
				$restful.post('news/delete', params, function (error, resp){
					callback(error, resp)
				});
			},



		};
		return News;
	}])