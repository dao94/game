<?php namespace App\Http\Controllers\Api\product;

use Illuminate\Http\Request;
use Validator;
use App\Models\Category as Category;
use App\Models\DealPricing as DealPricing;
use App\Models\DealPricingItem as DealPricingItem;
use App\Models\User as User;

use App\Http\Controllers\Controller;
use DB;
use Response;
use PHPMailer;
class DealPricingController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public $request;
    
    public function __construct()
    {   

    }

    public function getIndex (Request $request, $id = 0){
        $DealPricing = new DealPricing;
        $DealPricing = $DealPricing->orderBy('id', 'DESC')->with(['Items', 'User']);
        if($id > 0){
            $Data = $DealPricing->where('id',$id)->first();
        }else {
            $Data = $this->paging($DealPricing, $request);
        }
        
        return $this->ResponseData($Data);

    }

    public function getBaoGia(Request $request){
        $token   = $request->input('token');
        if(empty($token)){
            return view('errors.503');
        }

        $DealPricing = new DealPricing;
        $DealPricing = $DealPricing->orderBy('id', 'DESC')->with(['Items', 'User'])->where('token', $token);
        $Data        = $DealPricing->first();
        
        if(empty($Data)){
            return view('errors.503');   
        }
        return view('baogia', ['data' => $Data]);
    }
    public function postSave(Request $request) {
        $items = $request->input('item');
        $info  = $request->input('info');
        $idPr  = isset($info['id']) ?  $info['id'] : '';
        if(empty($info)){
            $this->error         = true;
            $this->error_message = "Dữ liệu người dùng không đúng";
            goto next;
        }
        
        $DealPricing               = $idPr ? DealPricing::find($idPr) : new DealPricing;
        $DealPricing->user_id      = $this->getUser($request)->id;
        $DealPricing->to_name      = $info['to_name'];
        $DealPricing->token        = md5($info['to_email']).time();
        $DealPricing->to_company   = $info['to_company'];
        $DealPricing->to_email     = $info['to_email'];
        $DealPricing->to_fax       = isset($info['to_fax']) ? $info['to_fax'] : "";
        $DealPricing->to_phone     = isset($info['to_phone']) ? $info['to_phone'] : "";
        $DealPricing->to_phone2    = isset($info['to_phone2']) ? $info['to_phone2'] : "";
        $DealPricing->to_cc        = isset($info['to_cc']) ? $info['to_cc'] : "";
        $DealPricing->delivery_day = isset($info['delivery_day']) ? $info['delivery_day'] : "";
        $DealPricing->time_create  = time();
        
        try {
            $DealPricing->save();
        } catch (Exception $e) {
            $this->error         = true;
            $this->error_message = "Lỗi truy vấn";
            goto next;
        }

        $saveItem = [];
      
        foreach ($items as $key => $value) {
            try {
                $obj               = $idPr ? DealPricingItem::find($value['id']) : new DealPricingItem;
                $obj->product_id   = isset($value['product_id']) ? $value['product_id'] : 0;
                $obj->deal_id      = $DealPricing->id;
                $obj->product_name = $value['product_name'];
                $obj->description  = $value['description'];
                $obj->unit         = $value['unit'];
                $obj->quantity     = $value['quantity'];
                $obj->price        = $value['price'];
                $obj->save();   
            } catch (Exception $e) {
                $this->error         = true;
                $this->error_message = "Lỗi truy vấn";
                goto next;    
            }
        }

        next:
        return $this->ResponseData([]);
    }


    public function postAccept (Request $request){
        $id   = $request->input('id');
        $DealPricing = new DealPricing;
        $DealPricing = $DealPricing->orderBy('id', 'DESC')->with(['Items', 'User'])->where('id', $id);
        $Data        = $DealPricing->first();

        $Data->time_accept = time();
        $Data->user_accept = $this->getUser($request)->id;
        $this->request = $request;
        try {
            if(!$this->sendEmail($Data, $Data->token)){
                $this->error = true;
                $this->error_message = "Gui email loi";
                return $this->ResponseData([]);
            }
            $rs = $Data->save();
        } catch (Exception $e) {
            $this->error = true;
            return $this->ResponseData([]);
        }

        return $this->ResponseData([]);

    }

    public function postRemove (Request $request){
        $id          = $request->input('id');
        $DealPricing = new DealPricing;
        $DealPricing = $DealPricing->orderBy('id', 'DESC')->with(['Items', 'User'])->where('id', $id);
        $Data        = $DealPricing->delete();
        return $this->ResponseData([]);
    }



    public function sendEmail($DealInfo, $token){
        $mail = new PHPMailer;
        $settings = $this->getSetting();

        $Model  = new User();
        $user   = $Model->where('id', $this->getUserId($this->request))->first();
        
        if(!$user){
            return false;
        }
        //Enable SMTP debugging. 
        $mail->SMTPDebug = 0;                               
        $mail->isSMTP();        
        $mail->CharSet = "UTF-8";
        $mail->Mailer = "smtp";
        $mail->Host = "mail.yenhung.vn";
        $mail->SMTPAuth = true;                          
        $mail->Username = $user->email_sender;
        $mail->Password = $user->email_sender_pwd;
        $mail->SMTPSecure = "tls";    
        $mail->Port = 25;                                   
        $mail->From = $user->email_sender;
        $mail->FromName = $settings['site_name'];;
        $mail->addAddress($DealInfo->to_email, $DealInfo->to_name);
        $mail->isHTML(true);

        $mail->Subject = "Bảng báo giá";
        
        $content = $settings['email_deal'];

        if($DealInfo->to_cc){
            $list_cc = explode(',', $DealInfo->to_cc);
            foreach ($list_cc as $key => $value) {
                $mail->AddCC(trim($value));
            }
        }

        $content = str_replace("{email}", $DealInfo->to_email, $content);
        $content = str_replace("{name}", $DealInfo->to_name, $content);
        $content = str_replace("{link}", url()."/bao-gia?token=".$token, $content);

        $mail->Body = $content;

        //$mail->AltBody = "This is the plain text version of the email content";

        if(!$mail->send()) 
        {
            return false;
        } 
        return true;
    }

}   
