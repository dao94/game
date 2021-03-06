<?php namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use App\Models\User as User;
use App\Models\Slide as Slide;
use DB;
class AccountController extends Controller {

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
		$Model  = new User();
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
		$id    = $request->input('id');
		$stt   = $request->input('level');
		$level = $stt == 0 ? 1 : 0;
		try {
			if(!isset($id) && empty($id))
				return false;
			$rs = DB::table('user')->where('id',$id)->update(array('level' => $level));
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
			$checkIdAdmin = User::find($id);
			if($checkIdAdmin->level == 2) {
				$this->error         = true;
				$this->error_message = 'Không thể xóa admin cao cấp';
				goto next;
			}
			$rs    = DB::table('user')->where('id', '=',$id)->delete();
			if($rs == true) {
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


	public function postUpdateUser(Request $request){
		$email_sender   	= $request->input('email_sender');
		$email_sender_pwd 	= $request->input('email_sender_pwd');

		if(empty($email_sender) || empty($email_sender_pwd)){
			$this->error = true;
			$this->error_message = "Dữ liệu không đúng";
			goto next;
		}
		$Model  = new User();
		$user 	= $Model->where('id', $this->getUserId($request))->first();
		if(empty($user)){
			$this->error = true;
			$this->error_message = $e->getMessage();
			goto next;
		}

		$user->email_sender 	= $email_sender;
		$user->email_sender_pwd = $email_sender_pwd;
		$user->save();


		next:
		return $this->ResponseData();	
	}

	public function getEmailSender(Request $request){
		$Data = [];
		$Model  = new User();
		$user 	= $Model->where('id', $this->getUserId($request))->first();
		if(empty($user)){
			$this->error = true;
			$this->error_message = $e->getMessage();
			goto next;
		}

		$Data = [
			'email_sender' 		=> !empty($user->email_sender) 		? $user->email_sender : "",
			'email_sender_pwd' 	=> !empty($user->email_sender_pwd) 	? $user->email_sender_pwd : ""
		];
		

		next:
		return $this->ResponseData($Data);	
	}

}
