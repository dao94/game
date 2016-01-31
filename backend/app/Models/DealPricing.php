<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
class DealPricing extends Model {

	

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table 	= 'deal_pricing';
	protected $hidden 	= array();
	var $timestamps 	= false;

	public function Items(){
		return $this->hasMany('App\Models\DealPricingItem','deal_id','id');
	}

	public function User(){
		return $this->belongsTo('App\Models\User','user_id', 'id');
	}



	
}
