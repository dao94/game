<?php namespace App\Http\Controllers\User;
use App\Quotation;
use App\Http\Controllers\Controller;
use App\Http\Models as Models;
use DB;
use View;
use Illuminate\Http\Request;
use  App\Models\News as News;

class NewsController extends Controller {

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
	public function index(Request $request)
	{
		$Model  = new News;
		$News  = $Model->orderBy('id', 'DESC');
		$News  = $this->paging($News, $request, false);

		$data = [
			"title"     	=> "Tin tức",
			'news'      	=> $News,
			'total'			=> $this->total,
			'total_page'	=> $this->total_page,
		];
		return View::make('user/news', $data);
	}

	public function detail($slug) {
		$explodeSlug = explode('-', $slug);
		$newId       = explode('.', end($explodeSlug))[0];
		if(!$newId)
			return false;
		$news    = News::detail($newId);
		$data = 
		[
			"title"       => $news ? $news->name : '',
			'news'        => $news,
			'description' => $news->description,
			'keywords'    => $news->keywords
		];
		return View::make('user/detailnews', $data);
	}


}
