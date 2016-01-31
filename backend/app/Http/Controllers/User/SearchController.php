<?php namespace App\Http\Controllers\User;
use App\Quotation;
use App\Http\Controllers\Controller;
use App\Http\Models as Models;
use DB;
use View;
use Illuminate\Http\Request;
use  App\Models\Provider as Provider;
use  App\Models\Product as Product;

class SearchController extends Controller {

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
	public function index() {

		$query = $this->req->get('query');
		if(empty($query)){
			return View::make('user/search', [
				"title" 		=> "Tìm kiếm",
				'product'		=> [],
				'total'			=> '',
				'total_page'	=> '',
				'query'			=> $query
			]);
		}

		$Model = new Product;
		$Model = $Model->where('name', 'LIKE', '%'.$query.'%')->orderBy('id', 'DESC');

		$Model = $this->paging($Model, $this->req, false);

		$data = 
		[	
			'title'      => 'Tìm kiếm với từ khóa: '.$query,
			'product'    => $Model,
			'total'			=> $this->total,
			'total_page'	=> $this->total_page,
			'query'			=> $query
		];
		return View::make('user/search', $data);
	}


}
