<?php namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Http\Controllers\Controller;
class LoginController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	
	public function __construct()
	{	
		parent::__construct();
	}

	public function getList() {
		return response()->json(['name' => 'Abigail', 'state' => 'CA']);
	}

	public function postRegister(Request $request) {
		$v = Validator::make($request->all(),[
			'password' => 'required',
			'phone'    => 'required',
			'name'     => 'required',
			'email'    => 'email:required|max:255',
		]);

		$data = '';
		
		if($v->fails()) {
			$this->error = true;
			$this->error_message = 'Thông tin không chính xác hoặc không đầy đủ, vui lòng thử lại!';
			goto next;
		}

		$email      =  $request->get('email');
		$phone      =  $request->get('phone');
		$name       =  $request->get('name');
		$repassword = md5(md5($request->get('repassword')));
		$password   =  md5(md5($request->get('password')));
		if($password != $repassword) {
			$this->error         = true;
			$this->error_message = 'Xác nhận mật khẩu không chính xác !';
			goto next;
		}

		try {
			$checkEmail = User::existsEmail($email);
			if($checkEmail) {
				$this->error = true;
				$this->error_message = 'Xin lỗi email này đã tồn tại vui lòng thử lại !';
				goto next;
			}

			$newUser = array(
				'email'    => $email,
				'password' => $password,
				'name'     => $name,
				'phone'    => $phone,
				// 'level'    => User::ARTIST
    		);

			$insertId    = User::insertGetId($newUser);	
			if($insertId) {
				$data = ['id' => $insertId];
				$this->message = 'Đăng ký tài khoản thành công ,Vui lòng liên hệ tới admin để được cấp quyền truy cập';
			}
		} catch (Exception $e) {
			$this->error   = true;
			$this->message = $e->getMessage();
		}

		next:
		return $this->ResponseData($data);
	}

	public function postLogin(Request $request) {
		try {
			$data = '';
			$v    = Validator::make($request->all(),[
				'password' => 'required',
				'email'    => 'required'
			]);
			
			if($v->fails()) {
				$this->error = true;
				$this->error_message = 'Thông tin không chính xác hoặc không đầy đủ, vui lòng thử lại!';
				goto next;
			}

			$email    = $request->get('email');
			$password = md5(md5($request->get('password')));
			$login    = User::checkLogin($email, $password);

			if(!$login) {
				$this->error = true;
				$this->error_message = 'Email của bạn nhập không chính xác hoặc chưa được kích hoạt ,vui lòng liên hệ tới admin để được xác nhận';
				goto next;
			}

			$token = User::createToken([
				'id'    => $login->id,
				'email' => $login->email,
				'level' => $login->level
			]);

			$data = [
				'id'    => $login->id,
				'email' => $login->email,
				'name'  => $login->name,
				'token' => $token,
				'level' => $login->level
			];

			$this->message = "Đăng nhập thành công , hệ thống sẽ chuyển trong giây lát";	
			next:
			return $this->ResponseData($data);
		} catch (Exception $e) {
			$this->error = true;
			$this->error_message = $e->getMessage();
		}

	}

}
