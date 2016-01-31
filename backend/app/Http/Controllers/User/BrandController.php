<?php namespace App\Http\Controllers\User;
use App\Quotation;
use App\Http\Controllers\Controller;
use App\Http\Models as Models;
use DB;
use View;
use Illuminate\Http\Request;
use  App\Models\Provider as Provider;
use  App\Models\Product as Product;

class BrandController extends Controller {

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

	public $req = null;
	public function __construct(Request $request)
	{
		$this->req = $request;
		parent::__construct();
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index($slug) {
		$explodeSlug = explode('-', $slug);
		$brandId     = explode('.', end($explodeSlug))[0];

		if(!$brandId)
			return false;
		$obj         = new Product();
		$AllparentID = Provider::where('parent_key',$brandId)->get()->toArray();
		$idPr        = [];

		if($AllparentID) {
			foreach ($AllparentID as $val) {
				array_push($idPr, $val['id']);
			}
			$res = Product::whereIn('provider_id',$idPr)->orderBy('id','desc');
		} else {
			$res  = Product::where('provider_id',$brandId)->orderBy('id','desc');
		}

		$res = $this->paging($res, $this->req, false);

		$brandName = Provider::find($brandId);
		$data = 
		[	
			'title'      => 'Nhãn hiệu',
			'brand_name' => $brandName->name,
			'product'    => $res,
			'total'			=> $this->total,
			'total_page'	=> $this->total_page,
		];
		return View::make('user/brand', $data);
	}


}
