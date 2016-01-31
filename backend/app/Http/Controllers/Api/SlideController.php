<?php namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use App\Models\Slide as Slide;
use DB;
class SlideController extends Controller {

	/**
	 * Hiển thị danh sách sản phẩm
	 * @author daotc94@gmail.com
	 * @return void
	 */

	public function __construct()
	{
		parent::__construct();
	}

	/*Hiển thị danh sách slide*/
	public function getIndex(Request $request)
	{
		$Model  = new Slide();
		$Total  = $Model->get()->count();
		$Model  = $Model->orderBy('id','DESC');
		$data   = $this->paging($Model, $request);
		$totals = ['total' => $Total];
		return $this->ResponseData($data, $totals);
	}

	/*Thêm mới slide */
	public function postAdd(Request $request){
		$data  = '';
		$name  = $request->input('name');
		$alt   = $request->input('alt');
		$image = $request->input('images');
		if(isset($name) && !empty($name)) {
			$table              = new Slide;
			$table->name        = $name;
			$table->create_time = date("Y-m-d H:i:s");
			$table->images      = $image;
			$table->alt         = $alt;
			$table->status      = 2;// 2 : không chọn , 1 là được chọn
			$rs                 = $table->save();
			$LastInsertId       = $table->id;
			$data               = 
			[
				'id'          => $LastInsertId,
				'name'        => $name,
				'create_time' => date("Y-m-d H:i:s"),
				'images'      => $image,
				'alt'         => $alt,
				'status'      => 2// 2 : không chọn , 1 là được chọn
			];
			$this->message = 'Thêm thành công !';
		} else {
			$this->error         = true;
			$this->error_message = 'Vui lòng nhập đầy đủ dữ liệu ';
		}
		return $this->ResponseData($data);
	}

	/*chỉnh sửa trạng thái */
	public function postChangestatus(Request $request) {
		$id     = $request->input('id');
		$stt    = $request->input('status');
		$status = $stt == 1 ? 2 : 1;
		try {
			if(!isset($id) && empty($id))
				return false;
			$rs = DB::table('slide')->where('id',$id)->update(array('status' => $status));
			if($rs) {
				$this->message = 'Cập nhật trạng thái thành công !';
				goto next;
			} else {
				$this->error = true;
				$this->error_message = 'Cập nhật trạng thái không thành công !';
				goto next;
			}	
		} catch (Exception $e) {
			$this->error = true;
			$this->error_message = $e->getMessage();
			goto next;
		}
		next:
		return $this->ResponseData();
	}

	public function getByid(Request $request) {
		$id   = $request->input('id');
		$data = '';
		if(!$id) {
			$this->error         = true;
			$this->error_message = '';
			goto next;
		}
		$data = Slide::find($id);
		next:
		return $this->ResponseData($data);
	}

	/*chỉnh sửa slide*/
	public function postUpdate(Request $request) {
		$id    = $request->input('id');
		$name  = $request->input('name');
		$alt   = $request->input('alt');
		$image = $request->input('images');
		$data  = '';
		try {
			if(isset($name) && !empty($name)) {
				$table              = Slide::find($id);
				$table->name        = $name;
				$table->update_time = date("Y-m-d H:i:s");
				$table->images      = $image;
				$table->alt         = $alt;
				$rs                 = $table->save();
				$data = 
				[
					'id'          => $id,
					'name'        => $name,
					'update_time' => date("Y-m-d H:i:s"),
					'images'      => $image,
					'alt'         => $alt,
				];
				$this->message = 'Cập nhật thành công';
			} else {
				$this->error         = true;
				$this->error_message = 'Vui lòng nhập đầy đủ thông tin';
				goto next;
			}	
		} catch (Exception $e) {
			$this->error         = true;
			$this->error_message = $e->getMessage();
			goto next;
		}
		next:
		return $this->ResponseData($data);
	}
	/*xóa tin tức */
	public function postDelete(Request $request) {
		$id   = $request->input('id');
		if(!isset($id) && empty($id))
			return false;
		try {
			$image = DB::table('slide')->where('id','=',$id)->pluck('images');
			$rs    = DB::table('slide')->where('id', '=',$id)->delete();
			$path  = "uploads/".$image;
			if($rs == true) {
				if($image !=""){
					unlink($path);	
				}
				$this->message = 'Xóa thành công';
				goto next;
			} else {
				$this->error = true;
				$this->error_message = '';
				goto next;
			}	
		} catch (Exception $e) {
			$this->error = true;
			$this->error_message = $e->getMessage();
			goto next;
		}
		next:
		return $this->ResponseData();
	}

}
