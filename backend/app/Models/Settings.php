<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Settings extends Model {

	

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'settings';
	
	var $timestamps = false;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	static function getSetting(){
		$Data = Settings::get()->all();
		$Result = [];
		foreach ($Data as $key => $value) {
			$Result[$value['key']] = $value['value'];
		}
		return $Result;
	}
}
