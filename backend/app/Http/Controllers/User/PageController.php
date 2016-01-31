<?php namespace App\Http\Controllers\User;
use App\Quotation;
use App\Http\Controllers\Controller;
use App\Http\Models as Models;
use DB;
use View;
use Illuminate\Http\Request;
use  App\Models\Page as Page;

class PageController extends Controller {

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
		$res  = Page::find(2);
		$data = [
			"title" => $res->name,
			'intro' => $res
		];
		return View::make('user/introduce', $data);
	}

	public function guide() {
		$res  = Page::find(4);
		$data = [
			"title" => $res->name,
			'intro' => $res
		];
		return View::make('user/guide', $data);	
	}

	public function advisory() {
		$res  = Page::find(5);
		$data = 
		[
			"title" => $res->name,
			'intro' => $res
		];
		return View::make('user/advisory', $data);	
	}

}
