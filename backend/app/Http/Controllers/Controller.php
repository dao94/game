<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Redis;
use View;
use Config;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use \Firebase\JWT\JWT;
use App\Models\Settings;
use App\Models\Category;
use App\Models\Product;
use App\Models\News;
use App\Models\Provider;
use App\Models\Page;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public $error         = false;
	public $message       = '';
	public $error_message = '';
    public $setting       = [];


    public $limit = 20;
    public $page  = 1;
    public $total = 0;
    public function __construct() {
        $this->setting          = Settings::getSetting();
    	View::share('listNewPd' , $this->_getNewProduct());
        View::share('listNewsTop' , $this->_getNewsTop());
        View::share('Category' , $this->getCategoryShowInIndex());
        View::share('menu_provider', $this->getProviderShowInIndex());
        View::share('setting' , $this->setting);
        View::share('guideDes', Page::find(4));
        View::share('title' , "");
    }
    static function getSetting(){
        return Settings::getSetting();
    }

    public function ResponseData($data = [], $additional = []) {
    	$Workflow = [
			'error'         => $this->error,
			'message'       => $this->message,
			'error_message' => $this->error_message,
			'data'          => $data
    	];
        $Workflow = array_merge($Workflow, $additional);
        
    	return response()->json($Workflow);
    	
    }

    public function getUser($request){  
        $user = $request->get('user_decoded')->data;
        if(!$user) 
            return false;
        return $user;   
    }

    public function getUserId($request) {
        $userId = $this->getUser($request)->id;
        if(!$userId) 
            return false;
        return $userId;
    }

    public function paging ($model, Request $request, $arr = true){
        $this->page     = $request->has('page')  ? (int)$request->get('page')  : $this->page;
        $this->limit     = $request->has('limit') ? (int)$request->get('limit') : $this->limit;
        $offset         = ($this->page - 1) * $this->limit;

        $this->total      = $model->count();
        $this->total_page = ceil($this->total / $this->limit);


        $model =  $model->skip($offset)->take($this->limit)->get();
        if($arr){
            return $model->toArray();
        }
        return $model;

    }

    public function getMenuCategory($active = ""){
        $Model = new Category;
        $Data = $Model->orderBy('id', 'DESC');
        if(!empty($active)){
            $Data = $Data->where('active', $active);
        }
        return $Data->get()->toArray();
    }

    private function getCategoryShowInIndex (){
        $ListCategory = Category::where('parent_key', 0)->with(['Child'=> function ($query){
            return $query->orderBy('ordinal', 'ASC');
        }])->orderBy('ordinal', 'ASC');
        return $ListCategory->get();
    }

    private function getProviderShowInIndex (){
        $ListProvider = Provider::where('active', 1)->where('parent_key', 0)->with(['Child'=> function ($query){
            return $query->orderBy('ordinal', 'ASC');
        }])->orderBy('ordinal', 'ASC');
        return $ListProvider->get();
    }

    private function _getNewProduct() {
        $obj = new Product();
        $res = $obj->getNewestProducts();
        return $res;
    }

    private function _getNewsTop() {
        $obj = new News();
        $res = $obj->listNews(10);
        return $res;
    }

}

