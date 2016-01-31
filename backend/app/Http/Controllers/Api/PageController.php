<?php namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Response;
use DB;
use App\Models\Page;
class PageController extends Controller {

	/**
	 * 
	 * @author dao94 http://github.com/dao94
	 * @return Response <json>
	 */

	public function __construct()
	{
		parent::__construct();
	}

	public function getIndex(){
		$data = Page::get();
		return $this->ResponseData($data);
	}

	/*create page */
	public function postAdd(Request $request){
		$name    = $request->input('name');
		$content = $request->input('content');
		$status  = $request->input('status') ? 1 : 2;
		try {
			if(isset($name) && !empty($name)) {
				$table                = new Page();
				$table->name          = $name;
				$table->create_time   = date("Y-m-d H:i:s");
				$table->content       = $content;
				$table->status        = $status;
				$rs                   = $table->save();
				if($rs) {
					$this->message = 'Thêm mới thành công !';
				} else {
					$this->error         = true;
					$this->error_message = 'Thêm mới không thành công !';
				}
			} else {
				$this->error         = true;
				$this->error_message = 'Tên trang không được để trống';
			}
		} catch (Exception $e) {
			$this->error         = true;
			$this->error_message = $e->getMessage();
		}
		return $this->ResponseData();
	}

	/*chỉnh sửa trạng thái */
	public function postChange(Request $request) {
		$id     = $request->input('id');
		$stt    = $request->input('status');
		$status = $stt == 1 ? 2 : 1;
		if(!isset($id) && empty($id)) {
			return false;
		}
		try {
			$rs = DB::table('introduction')->where('id',$id)->update(array('status' => $status));	
			$this->message = 'Cập nhật thành công';
			goto next;
		} catch (Exception $e) {
			$this->error = true;
			$this->error_message = 'Lỗi, Cập nhật không thành công !';
		}
		next:
		return $this->ResponseData();
	}

	public function getByid(Request $request) {
		$id = $request->input('id');
		if(!$id) 
			return false;
		$data = Page::find($id);
		return $this->ResponseData($data);
	}

	/*edit page*/
	public function postUpdate(Request $request) {
		$id      = $request->input('id');
		$name    = $request->input('name');
		$content = $request->input('content');
		$status  = $request->input('status') ? 1 : 2 ;
		try {
			if(isset($name) && !empty($name)) {
				$table              = Page::find($id);
				$table->name        = $name;
				$table->update_time = date("Y-m-d H:i:s");
				$table->content     = $content;
				$table->status      = $status;
				$rs                 = $table->save();
				if($rs) {
					$this->message = 'Cập nhật thành công';
					goto next;
				} else {
					$this->error         = true;
					$this->error_message = 'Cập nhật không thành công';
					goto next;
				}
			} else {
				$this->error         = true;
				$this->error_message = 'Tên trang không được để trống';
				goto next;
			}	
		} catch (Exception $e) {
			$this->error         = true;
			$this->error_message = $e->getMessage();
			goto next;
		}
		next:
		return $this->ResponseData();
	}

	/*Del page */

	public function postDelete(Request $request) {
		$id   = $request->input('id');
		if(!isset($id) && empty($id)) {
			return false;
		}
		$rs    = DB::table('introduction')->where('id', '=',$id)->delete();
		if($rs) {
			$this->message = 'Xóa thành công !';
		} else {
			$this->error = true;
			$this->error_message = 'Xóa không thành công !';
		}
		return $this->ResponseData();
	}


}
