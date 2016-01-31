<?php namespace App\Http\Controllers\Api\product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use App\Models\Product as Product;
use App\Models\Category as Category;
use App\Models\Provider as Provider;
use DB;

class ProductController extends Controller {
	
	/**
	 * Hiển thị danh sách sản phẩm
	 * @author daotc94@gmail.com
	 * @return void
	 */

	public function __construct()
	{
		parent::__construct();
	}

	/*Hiển thị danh sách tin tức */
	public function getShow(Request $request){
		$categoryId = $request->categoryId;
		$providerId = $request->providerId;
		$Model      = new Product();
		$total      = $Model->getAll()->count();	
		$Model      = $Model->getAll()->orderBy('id','DESC');
		if($categoryId)
			$total = $Model->where('category_id', $categoryId)->count();
		if($providerId)
			$total = $Model->where('provider_id', $providerId)->count();
		$datas      = $this->paging($Model, $request);
		$arrTotal   = ['total' =>  $total];
		return $this->ResponseData($datas, $arrTotal);
	}

	public function postSearch(Request $request) {
		$search = $request->input('search');
		$data = Product::where('name' , 'like', '%'.$search.'%')->get();
		return $this->ResponseData($data);
	}

	public function getCategory(request $request) {
		$Model  = new Category();
		$Model  = $Model->orderBy('id','DESC')->where('parent_key','=','0');
		$datas  = $this->paging($Model, $request);
		$result = array();
		foreach ($datas as $k => $item) {
			$_data    = DB::table('category')->where('parent_key','=',$item['id'])->get();
			if(!empty($_data)) {
				foreach ($_data as $value) {
					$result[] = array(
					'id'    => $value->id,
					'group' => $item['name'],
					'name'  => $value->name
					);
				}	
			} else {
				$result[] = array(
					'id'   => $item['id'],
					'name' => $item['name']
				);
			}
			
		}
		return $this->ResponseData($result);
	}

	public function getProvider(request $request) {
		$Model  = new Provider();
		$Model  = $Model->orderBy('id','DESC')->where('parent_key','=','0');
		$datas  = $this->paging($Model, $request);
		$result = array();
		foreach ($datas as $k => $item) {
			$_data    = DB::table('provider')->where('parent_key','=',$item['id'])->get();
			if(!empty($_data)) {
				foreach ($_data as $value) {
					$result[] = array(
					'id'    => $value->id,
					'group' => $item['name'],
					'name'  => $value->name
					);
				}	
			} else {
				$result[] = array(
					'id'   => $item['id'],
					'name' => $item['name']
				);
			}
			
		}
		return $this->ResponseData($result);
	}

	/*chỉnh sửa trạng thái */
	public function postChangestatus(Request $request) {
		$id     = $request->input('id');
		$status = $request->input('status') == 1 ? 2 : 1;
		try {
			if(!isset($id) && empty($id)) {
				$this->error_message = 'ID is empty ,please try again !';
				$this->error         = true;
				goto next;
			}
			$rs = DB::table('product')->where('id',$id)->update(array('status' => $status));	
			$this->message = 'Cập nhật trạng thái thành công';
			goto next;
		} catch (Exception $e) {
			$this->error         =  true;
			$this->error_message = $e->getMessage();
		}
		next:
		return $this->ResponseData();
		
	}

	
	/*Thêm mới sản phẩm*/
	public function postAdd(Request $request){
		$name        = $request->input('name');
		$category_id = $request->input('category_id');
		$provider_id = $request->input('provider_id');
		$image       = $request->input('images') ? json_encode($request->input('images')) : '';
		$alt         = $request->input('alt');
		$des         = $request->input('description');
		$content     = $request->input('content');
		$price       = $request->input('price');
		$status      = $request->input('status');
		$keywords    = $request->input('keywords');
		$id          = $request->input('id');
		if(isset($name) && !empty($name) && !empty($des)) {
			try {
				$table              = $id ? Product::find($id) : new Product;
				$table->name        = $name;
				$table->category_id = $category_id;
				$table->provider_id = $provider_id;
				$table->alt         = $alt;
				$table->images      = $image;
				$table->description = $des;
				$table->content     = $content;
				$table->price       = $price;
				$table->keywords    = $keywords;
				$table->status      = $status ? 1 : 2;
				$table->create_time = date("Y-m-d H:i:s");
				$rs                 = $table->save();
				if($rs) {
					$this->message = $id ? 'Cập nhật' : 'Thêm  mới';
					$this->message.= ' sản phẩm thành công';
					goto next;
				} else {
					$this->error = true;
					$this->error_message = 'error !';
					goto next;
				}
			} catch (Exception $e) {
				$this->error = true;
				$this->error_message = $e->getMessage();
				goto next;
			}
		} else {
			$this->error         = true;
			$this->error_message = 'null';
		}
		next:
		return $this->ResponseData();
	}

	public function postListbyid(Request $request) {
		$id   = $request->input('id');
		$data = '';
		if(!$id) {
			$this->error         = true;
			$this->error_message = 'is is empty !';
		}
		try {
			$data = Product::find($id);
			$data['images'] = json_decode($data['images']);
			goto next;
		} catch (Exception $e) {
			$this->error = true;
			$this->error_message = $e->getMessage();
			goto next;
		}
		next:
		return $this->ResponseData($data);
	}

	/*xóa sản phẩm*/
	public function postDelproduct(Request $request) {
		$id   = $request->input('id');
		if(!isset($id) && empty($id)) {
			$this->error = true;
			$this->error_message  = 'Id is empty , please try again !';
			goto next;
		}
		$table = new Product;
		$table = Product::find($id);
		// $image = DB::table('product')->where('id','=',$id)->pluck('images');
		$rs    = $table->delete();
		// $path  = "uploads/".$image;
		if($rs == true) {
			// if($image !=""){
			// 	unlink($path);	
			// }
			$this->message = 'Xóa sản phẩm thành công !';
			goto next;
		} else {
			$this->error =  true;
			$this->error_message = 'not ok !';
			goto next;
		}
		next:
		return $this->ResponseData();
		return json_encode($arr);
	}



	public function getSuggest(Request $request){
		$query = $request->input('query');
		$table = new Product;

		$table = $table->where('name', 'LIKE', '%'.$query.'%')->get()->toArray();
		return $this->ResponseData($table);
	}

}
