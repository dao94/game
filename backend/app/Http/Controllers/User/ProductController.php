<?php namespace App\Http\Controllers\User;
use App\Quotation;
use App\Http\Controllers\Controller;
use App\Http\Models as Models;
use DB;
use View;
use Illuminate\Http\Request;
use  App\Models\News as News;
use  App\Models\Product as Product;

class ProductController extends Controller {

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
	protected $curentUrl = '';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(Request $request)
	{
		parent::__construct();
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	

	public function detail($slug) {

		$explodeSlug = explode('-', $slug);
		$product_id          = explode('.', end($explodeSlug))[0];


		if(!$product_id)
			return View::make('errors/503');


		$model = new Product();
		$product = $model->getAll()->where('id', $product_id)->first();
		

		if(empty($product)){
			return View::make('errors/503');
		}

		$relatedProduct = $model->getAll()->where('category_id', $product->category_id)->get();
		$data = [
			"title"            => $product ? $product->name : '',
			'product'          => $product,
			'keywords'         => $product ? $product->keywords : '',
			"description"      => $product ? $product->description : '',
			'releated_product' => $relatedProduct
		];


		return View::make('user/detail_product', $data);
	}


}
