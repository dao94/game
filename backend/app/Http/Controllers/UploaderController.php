<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Validator;
class UploaderController extends Controller {

	public $file;
	public $extension;
	public $newName;
	public $folder_prefix = 'thumbs';

	private function fileHandler ($request, $folder_prefix = ""){
		$this->file         = $request->file('file');
		$this->extension    = $this->file->getClientOriginalExtension();
		if($folder_prefix){
			$this->folder_prefix = $folder_prefix;
		}

		//$this->newName = $this->folder_prefix.'/'.md5($this->file->getFilename().time()).'.'.$this->extension;
		$this->newName = $this->folder_prefix.'/'.$this->file->getClientOriginalName();

		$result       = Storage::disk('upload')->put($this->newName,  File::get($this->file));
		return $result;
	}

	public function postIndex(Request $request){

		if($this->fileHandler($request, 'art_images')){
			$this->error = false;
			$this->error_message = $this->file;
			return $this->ResponseData($this->newName);
		}

		$this->error = true;
		$this->error_message = "Tải lên thất bại";
		
		return $this->ResponseData($this->newName);

	}

}
