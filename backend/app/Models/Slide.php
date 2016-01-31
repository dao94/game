<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Slide extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'slide';
	
	var $timestamps = false;
	protected $hidden = array();

	
	public function getlist() {
		$_ObjImage = DB::table('slide')->select('id','name','alt','images')->where('status','=','1')->orderBy('create_time')->get();	
		return $_ObjImage;
	}
	

}
