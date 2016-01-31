<?php namespace App\Http\Controllers\User;
use App\Quotation;
use App\Http\Controllers\Controller;
use App\Http\Models as Models;
use DB;
use View;
use Illuminate\Http\Request;
use PHPMailer;


class ContactController extends Controller {

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
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{		
		$data = [];
		return View::make('user/contact', $data);
	}
	public function insert (Request $request){
		$params = $request->all()['contact'];

		$email  = $params['email'] ? $params['email']: '';
		$name  = $params['name'] ? $params['name']: '';
		$body  = $params['body'] ? $params['body']: '';

		if(empty($email) || empty($name) || empty($body)){
			return View::make('user/contact', [
				'error' => "Vui lòng nhập đầy đủ dữ liệu !",
				'success'=> ""
			]);		
		}

		

		if($this->sendEmail($email, $name, $body)){
			return View::make('user/contact', [
				'error' => "",
				'success'=> "Cám ơn bạn đã gửi yêu cầu tới chúng tôi !"
			]);
		}
		return View::make('user/contact', [
				'error' => "Lỗi máy chủ, vui lòng thử lại sau",
				'success'=> ""
		]);
	}

	public function sendEmail($email, $name, $body){
        $mail = new PHPMailer;
        $settings = $this->getSetting();
        //Enable SMTP debugging. 
        $mail->SMTPDebug = 0;                               
        $mail->isSMTP();        
        $mail->CharSet = "UTF-8";
    
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;                          
        $mail->Username = $settings['email_sender_id'];
        $mail->Password = $settings['email_sender_password'];
        $mail->SMTPSecure = "tls";    
        $mail->Port = 587;                                   
        $mail->From = $settings['email_sender_id'];
        $mail->FromName = $settings['site_name'];
        $mail->addAddress($settings['email_notice'], "");
        $mail->isHTML(true);

        $mail->Subject = "Khách hàng ".$email." liên hệ ";
        $mail->Body = "<strong>Người gửi:</strong> ".$name." &lt;".$email."&gt; </br><strong>Nội dung thư :</strong> </br>$body";

        //$mail->AltBody = "This is the plain text version of the email content";

        if(!$mail->send()) 
        {
            return false;
        } 
        return true;
    }
}	
