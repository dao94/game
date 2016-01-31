<?php namespace App\Http\Controllers\User;
use App\Quotation;
use App\Http\Controllers\Controller;
use App\Http\Models as Models;
use DB;
use View;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use App\Models\Slide;
use App\Models\Product;

class HomeController extends Controller {

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
	public function getIndex(Request $request)
	{		
		$product = new Product();
		$slide   = new Slide();
		$data    = 
		[
			"title"					=> "Trang chủ",
			"slide"                  => $slide->getlist(),
			'category_show_in_index' => $this->getCategoryShowInIndex(),
		];
		return View::make('user/home', $data)->withModel($product);
	}

	private function getCategoryShowInIndex (){
		$ListCategory = Category::where('active', 1)->orderBy('ordinal', 'ASC');
		return $ListCategory->get();
	}

}
