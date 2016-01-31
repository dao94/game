<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Providers extends Model {

	

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'providers';
	
	var $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */


	public function getData($active = 1, $limit = null, $offset = null) {
		$Model = $this->orderBy('priority', 'ASC');

		if($active !== null){
			$Model = $Model->where('active', $active);
		}

		if($limit !== null){
			$Model = $Model->take($offset);
		}

		if($offset !== null){
			$Model = $Model->skip($offset);
		}

		return $Model->get();		
	}
}
