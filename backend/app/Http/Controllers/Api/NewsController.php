<?php namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Response;
use App\Models as Models;
use DB;
use Illuminate\Support\Facades\Session;
class NewsController extends Controller {

	/**
	 * Hiển thị danh sách tin tức
	 * @author thinhit http://github.con/thinhit
	 * @return Response <json>
	 */


	public $id 			= "";
	public $name 		= "";
	public $category 	= "";
	public $content 	= "";
	public $description = "";
	public $slug 		= "";
	public $image 		= "";
	public $status 		= "";
	public $user_id 	= "";

	public function __construct(Request $request)
	{
		$this->id          = $request->input('id');
		$this->name        = $request->input('name');
		$this->category    = $request->input('group_news_id');
		$this->content     = $request->input('content');
		$this->description = $request->input('description');
		$this->keywords    = $request->input('keywords');
		$this->images      = $request->input('images');
		$this->slug        = $request->input('slug');
		$this->status      = $request->input('status');
		$this->user_id     = $this->getUser($request)->id;
	}

	/*Hiển thị danh sách tin tức */

	public function getIndex(Request $request)
	{
		
		$stt   = $request->input('stt');
		$Model = new Models\News();

		$Total = $Model->get()->count();
		$Model = $Model->getAll();


		if(!empty($stt)) {
			$Model = $Model->where('status','=',$stt);
		}

		$Model = $Model->orderBy('id','DESC');
		$datas = $this->paging($Model, $request);

		return $this->ResponseData($datas, ['total'=> $Total]);
	}

	public function getShow(Request $request, $id){
		$Model = Models\News::find($id);
		return $this->ResponseData($Model, []);	
	}



	/*Thêm mới tin tức */
	public function postSave(Request $request){
		
		if(!empty($this->name) && !empty($this->category) && !empty($this->content)  && !empty($this->user_id) )  {

			$table                = new Models\News;
			$table->name          = $this->name;
			$table->create_time   = date("Y-m-d H:i:s");
			$table->group_news_id = $this->category;
			$table->images        = $this->images;
			$table->slug          = $this->slug;
			$table->description   = $this->description;
			$table->content       = $this->content;
			$table->user_id       = $this->user_id;
			$table->keywords      = $this->keywords;
			$table->status        = 1;// 2 : không chọn , 1 là được chọn
			$rs                   = $table->save();
			$LastInsertId         = $table->id;
			$data = [
					'id' 			=> $LastInsertId,
					'name'          => $this->name,
					'create_time'   => date("Y-m-d H:i:s"),
					'group_news_id' => $this->category,
					'images'        => $this->image,
					'description'   => $this->description,
					'content'       => $this->content,
					'status'        => 1// 2 : không chọn , 1 là được chọn
			];

			if($rs) {
				return $this->ResponseData($data);
			} 

			$this->error = true;
			$this->error_message = "Lỗi truy vấn, vui lòng thử lại sau";
			return $this->ResponseData([]);
		}

		$this->error = true;
		$this->error_message = "Dữ liệu gửi lên không đúng, vui lòng thử lại";
		return $this->ResponseData([]);
		
		
	}


	/*chỉnh sửa tin tức*/
	public function postEdit(Request $request) {

		$table                = Models\News::find($this->id);

		if(empty($table)){
			$this->error = true;
			$this->error_message = "Không tìm thấy bản tin";
			return $this->ResponseData([]);
		}


		$table->name          = $this->name 	? $this->name : $table->name;
		$table->group_news_id = $this->category ? $this->category : $table->group_news_id;
		$table->images        = $this->images 	? $this->images : $table->images;
		$table->description   = $this->description 	? $this->description : $table->description;
		$table->content       = $this->content 		? $this->content : $table->content;
		$table->status        = $this->status 		? $this->status : $table->status;
		$table->keywords      = $this->keywords 		? $this->keywords : $table->keywords;
		$table->update_time   = date("Y-m-d H:i:s");
		
		$rs                   = $table->save();
		
		if($rs) {
			return $this->ResponseData([]);
		} 

		$this->error 		 = true;
		$this->error_message = "Lỗi truy vấn, vui lòng thử lại sau";
		return $this->ResponseData([]);

	}
	/*xóa tin tức */

	public function postDelete(Request $request) {
		$id   = $request->input('id');
		if(!isset($id) && empty($id)) {
			return false;
		}
		$image = DB::table('news')->where('id','=',$id)->pluck('images');
		$rs    = DB::table('news')->where('id', '=',$id)->delete();
		$path  = "uploads/".$image;
		if($rs == true) {
			if($image !=""){
				unlink($path);	
			} else {
				// code
			} 
				
		} else {
			$this->error = true;
			$this->error_message = "Lỗi truy vấn, vui lòng thử lại";
		}
		return $this->ResponseData([]);
	}

}
