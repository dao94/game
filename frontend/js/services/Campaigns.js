angular.module('urbanApp')
	.service('Campaigns', [ '$http', '$resource', '$restful', function ( $http, $resource, $restful){
		
		var Campaigns = {
			save: function (frm, callback){
				var listField = 
				[
					'id',
					'account_id' ,
					'spent_limit',
					'campaign_id',
					'name'       ,
					'category'   ,
					'device'     ,
					'page'       ,
					'app'        ,
					'app_name'   ,
					'description',
					'main_description',
					'cta'        ,
					'app_icon'   ,
					'picture'    ,
					'platform'   ,
					'object_store_url',
					'target_id'  ,
					'bidding_id' ,
					'published'  ,
					'ads_name'   ,
					'placement'  ,
					'thumb'      ,
					'promote_url'
				];

				var data = {};

				angular.forEach(listField, function (key, value){
					if(frm.hasOwnProperty(key) && frm[key] !== undefined && frm[key] !== null && frm[key] !== ""){
						data[key] = frm[key];

						if(key == 'spent_limit'){
							data[key] = get_number(frm[key]);
						}
						
					}
				})

				$restful.post('campaings/create', data, function (error, resp){
					callback(error, resp);
				})
			},
			show: function (id, callback){
				if(!id){
					return callback('ID not null');
				}
				var url = 'campaings/show/'+ id;
				$restful.get(url, function  (error, resp){
					callback(error, resp);
				})
			}
		};
		return Campaigns;
	}])