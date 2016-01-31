<?php namespace App\Http\Controllers\Api\news;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use App\Models as Models;
use DB;
// use Carbon\Carbon;

class GroupnewsController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Hiển thị danh sách nhóm tin tức
	 * @author daotc94@gmail.com
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/*Hiển thị Nhóm tin tức*/
	public function getIndex(Request $request)
	{	
		$Model = new Models\Group_news();
		$Total = $Model->get()->count();
		$Model = $Model->orderBy('id','DESC');
		$datas = $this->paging($Model, $request);



		return $this->ResponseData($datas, ['total'=>$Total]);
	}



	public function postSave(Request $request){
		$name    	= $request->input('name');
		$slug      	= $request->input('slug');
		$active     = $request->input('active') ? $request->input('active') : 2;

		$ReturnData = [];
		if(empty($name)){
			$this->error 		 = true;
			$this->error_message = "Dữ liệu không đúng, vui lòng thử lại";
			goto next;
		}


		$check_exist = DB::table('group_news')->where('name', $name)->first();
		if($check_exist){
			$this->error 		 = true;
			$this->error_message = "Tên chuyên mục đã tồn tại trên hệ thống, vui lòng kiểm tra lại";
			goto next;
		}

		try {
			$Model              = new Models\Group_news;
			$Model->name        = $name;
			$Model->slug        = $slug; //TODO : Nếu không truyền lên slug thì sẽ tự động sinh ra 
			$Model->active      = $active;
			$Model->create_time = date("Y-m-d H:i:s");
			$Result             = $Model->save();

		} catch (Exception $e) {
			$this->error = true;
			$this->error_message = "Truy vấn lỗi, vui lòng thử lại";
			goto next;
		}

		$LastInsertId            = $Model->id;

		$ReturnData                    = [
			'id'          => $LastInsertId,
			'name'        => $name,
			'slug'        => $slug, 
			'active'      => $active,
			'create_time' => date("Y-m-d H:i:s")
		];

		next:
		return $this->ResponseData($ReturnData);
		
	}
	
	/*Chỉnh sửa nhóm tin tức*/
	public function postEdit(Request $request) {
		$id         = $request->input('id');
		$name    	= $request->input('name');
		$slug      	= $request->input('slug');
		$active     = $request->input('active');

		$ReturnData = [];
		if(empty($id)){
			$this->error 		 = true;
			$this->error_message = "Dữ liệu không đúng, vui lòng thử lại";
			goto next;
		}
		
		$Model 		= new Models\Group_news;
		$Model      = $Model->where('id', $id)->first();

		if(empty($Model)){
			$this->error 		 = true;
			$this->error_message = "Không tìm thấy chuyên mục";
			goto next;
		}
			
		try {
			$Model->name 		= empty($name) ? $Model->name : $name;
			$Model->slug        = empty($slug) ? $Model->slug : $slug;
			$Model->active      = empty($active) ? $Model->active : $active;
			$Model->update_time = date("Y-m-d H:i:s");
			$Result				= $Model->save();
		} catch (Exception $e) {
			$this->error = true;
			$this->error_message = "Truy vấn lỗi, vui lòng thử lại";
			goto next;
		}

		$ReturnData                    = '';


		next:
		return $this->ResponseData($ReturnData);
	}

	/*Xóa nhóm tin tức*/
	public function postDelete(Request $request) {

		$id   = $request->input('id');

		$ReturnData = [];
		if(empty($id)){
			$this->error 		 = true;
			$this->error_message = "Dữ liệu không đúng, vui lòng thử lại";
			goto next;
		}


		$CheckHasPost = Models\News::where('group_news_id', $id)->count();
		
		if($CheckHasPost == 0 ) {
			try {
				$rs = Models\Group_news::find($id)->delete();
			} catch (Exception $e) {
				$this->error = true;
				$this->error_message = "Truy vấn lỗi, vui lòng thử lại";
				goto next;
			}
			
		} else {
			$this->error 		 = true;
			$this->error_message = "Vui lòng xóa hết bản tin trong chuyên mục này !";
			goto next;
		}
		
		$this->error_message = "Thành công";

		next:
		return $this->ResponseData($ReturnData);
	}

}
