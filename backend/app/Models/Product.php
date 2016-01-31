<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
class Product extends Model {

	

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'product';
	protected $hidden = array();
	var $timestamps = false;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	public function Provider(){
		return $this->hasOne('App\Models\Provider', 'id', 'provider_id')->select('id', 'name');
	}

	// Start for relations
	public function Category(){
		return $this->hasOne('App\Models\Category', 'id', 'category_id')->select('id', 'name');
	}
	// End for relations

	public function getAll(){
		$res = $this->with(array('Category', 'Provider'));
		$res  = $res->select('id', 'name','price', 'slug', 'alt','keywords','images','description', 'content', 'status', 'create_time', 'update_time','category_id','provider_id');
		return $res;
	}

	public function getData() {
		$_ret = $this->with(array('category'));
		$_ret = $_ret->select('id', 'name', 'slug', 'price', 'alt','keywords','images','description', 'content', 'status', 'create_time', 'update_time','category_id')->get();
		return $_ret;	
	}

	public function getNewestProducts($limit = 10){
		$result =  $this->with(array('category'))
						->select('id', 'name','price', 'slug', 'alt','keywords','images','description', 'content', 'status', 'create_time', 'update_time','category_id')
						->orderBy('id', 'DESC')
						->take($limit)
						->get();
		return $result;
	}

	public function getProductsByCategory($limit = 10,$category_id){
		$result =  $this->with(array('category'))
						->select('id', 'name','price', 'slug', 'alt','keywords','images','description', 'content', 'status', 'create_time', 'update_time','category_id')
						->where('status','=', 1)
						->where('category_id',$category_id)
						->orderBy('id', 'DESC')
						->take($limit)
						->get();
		return $result;
	}

	public function listProByIdAsc($limit) {
		$_Product = DB::table('product')
						->select('id', 'slug', 'alt','name','images','description')
						->orderBy('id','DESC')
						->take($limit)
						->get();	
		return $_Product;
	}

	public function listProBySttAsc($limit) {
		$_Product = DB::table('product')->select('id','slug', 'name','alt','images','description')->where('status','=',1)->orderBy('create_time')->take($limit)->get();	
		return $_Product;
	}

	public function listProductByCategory($category_id = null, $id = 0, $limit = 20,$stt = "") {


		$AllparentID = [];
		$idPr        = [];
		$res         = new Product();

		if($stt !== ""){
			$res = $res->where('status', $stt);
		}

		if($category_id !== null){
			$AllparentID = Category::where('parent_key',$category_id)->get()->toArray();

			foreach ($AllparentID as $val) {
				array_push($idPr, $val['id']);
			}
			$idPr[] = $category_id; 
			$res = $res->whereIn('category_id',$idPr)->orderBy('id','desc')->limit($limit)->get();
		}else {
		
			$res  = $res->orderBy('id','desc')->limit($limit)->get();
		}

		
		return $res;
	}


	public function listProductByProvider($provider_id, $id = 0, $limit = 20,$stt = 1) {
		if(empty($provider_id)) return false;

		if(empty($id)) {
			$_Product = DB::table('product')
							->select('id','name', 'slug', 'alt','images','description', 'price')
							->where('provider_id','=',$provider_id)
							->where('status','=',$stt)
							->orderBy('create_time', 'DESC')
							->take($limit)
							->get();	
		} else {
			$_Product = DB::table('product')
							->select('id','name', 'slug', 'alt','images','description', 'price')
							->where('provider_id','=',$provider_id)
							->where('status','=',$stt)
							->whereNotIn('id',[$id])
							->orderBy('create_time', 'DESC')
							->get();	
		}
		
		return $_Product;
	}

	public function searchProduct($seach) {
		$_Product = DB::table('product')
						->select('id','name','alt','images','description')
						->where("name","like","%$seach%")
						->orderBy('create_time')
						->get();	
		return $_Product;
	}

	
}
