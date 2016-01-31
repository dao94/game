<?php namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Response;
use DB;
use Illuminate\Support\Facades\Session;
use App\Models\Settings;
class SettingsController extends Controller {

	/**
	 * 
	 * @author thinhit http://github.con/thinhit
	 * @return Response <json>
	 */

	public function __construct()
	{
		
	}

	public function getIndex(){
		$settings  = Settings::getSetting();
		return $this->ResponseData($settings);
	}

	public function postSave (Request $request)
	{
		$Input = $request->all();
		try {
			foreach ($Input as $key => $value){
				if($key != 'user_decoded'){
					Settings::where('key', $key)->update(['value' => $value]);
				}
			}
		} catch (Exception $e) {
			$this->error = true;
			return $this->ResponseData([]);
		}
		return $this->ResponseData([]);
	}

}
