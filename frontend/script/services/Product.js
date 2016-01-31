angular.module('app')
	.service('Category', ['$resource', '$restful', function ($resource, $restful){
		
		var Product = {

			list : function(callback) {
				$restful.get('category/list', function (error, resp){
					callback(error, resp)
				});
			},

			listCategory : function (callback){
				$restful.get('category/show', function (error, resp){
					callback(error, resp)
				});
			},

			addCategory : function (data, callback){
				$restful.post('category/add', data, function (error, resp){
					callback(error, resp)
				});
			},

			saveCategory : function(data, callback) {
				$restful.post('category/update', data, function (error, resp) {
					callback(error, resp);
				});
			},

			listByid : function(id, callback) {
				$restful.get('category/listbyid', {'id' : id}, function (error, resp) {
					callback(error, resp);
				});
			},

			delById : function(id, callback) {
				$restful.post('category/delbyid', {'id' : id}, function (error, resp) {
					callback(error, resp);
				});
			}

		};
		return Product;
	}])	

	.service('Provider', ['$resource', '$restful', function ($resource, $restful){
		
		var Product = {

			list : function(callback) {
				$restful.get('provider/list', function (error, resp){
					callback(error, resp)
				});
			},

			listCategory : function (callback){
				$restful.get('provider/show', function (error, resp){
					callback(error, resp)
				});
			},

			addCategory : function (data, callback){
				$restful.post('provider/add', data, function (error, resp){
					callback(error, resp)
				});
			},

			saveCategory : function(data, callback) {
				$restful.post('provider/update', data, function (error, resp) {
					callback(error, resp);
				});
			},

			listByid : function(id, callback) {
				$restful.get('provider/listbyid', {'id' : id}, function (error, resp) {
					callback(error, resp);
				});
			},

			delById : function(id, callback) {
				$restful.post('provider/delbyid', {'id' : id}, function (error, resp) {
					callback(error, resp);
				});
			}

		};
		return Product;
	}])

	.service('Product', ['$resource', '$restful', function ($resource, $restful){
		
		var Product = {

			list_category : function(callback) {
				$restful.get('products/category', function (error, resp){
					callback(error, resp)
				});
			}, 

			list_provider : function(callback) {
				$restful.get('products/provider', function (error, resp){
					callback(error, resp)
				});
			}, 

			listProduct : function (data, callback){
				$restful.get('products/show', data, function (error, resp){
					callback(error, resp)
				});
			},

			changeStatus : function(data, callback) {
				$restful.post('products/changestatus', data, function (error, resp){
					callback(error, resp);
				})
			},

			add : function(data, callback) {
				$restful.post('products/add', data, function (error, resp){
					callback(error, resp);
				})
			},

			listProductById : function(data, callback) {
				$restful.post('products/listbyid', data, function (error, resp){
					callback(error, resp);
				})	
			},

			delProduct : function(data, callback) {
				$restful.post('products/delproduct', data, function (error, resp){
					callback(error, resp);
				})
			},

			suggestProduct : function (data, callback){
				$restful.get('products/suggest', data, function (error, resp){
					callback(error, resp)
				});
			},

		};
		return Product;
	}])

