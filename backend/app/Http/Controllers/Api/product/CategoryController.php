<?php namespace App\Http\Controllers\Api\product;

use Illuminate\Http\Request;
use Validator;
use App\Models\Category as Category;;
use App\Http\Controllers\Controller;
use DB;
class CategoryController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {   
        parent::__construct();
    }

    public function getList() {
       $data = Category::all();
       return $this->ResponseData($data);
    }

    public function getShow(Request $request) {
        $datas  = Category::where('parent_key', '=', 0)->get()->toArray();
        $result = [];
        foreach ($datas as $k => $item) {
            $_data    = Category::where('parent_key','=',$item['id'])->get()->toArray();
            $chilData = [];

            $result[] = 
            [
                'item'     => [
                    'name'       => $item['name'],
                    'parent_key' => $item['parent_key'],
                    'id'         => $item['id'],
                    'ordinal'    => $item['ordinal'],
                    'active'     => $item['active']
                ],
            ];

            foreach ($_data as $key => $value) {
                $result[$k]['children'][] =
                    [
                        'item'     => [
                            'name'       => $value['name'],
                            'parent_key' => $value['parent_key'],
                            'id'         => $value['id'],
                            'ordinal'    => $value['ordinal'],
                            'active'     => $value['active']
                    ],
                    'children' => []
                ];
            }
        }
        return $this->ResponseData($result);
    }

    public function getListbyid(Request $request) {
        $id      = $request->input('id');
        $getData = Category::find($id);
        return $this->ResponseData($getData);
    }

    public function postAdd(Request $request){
        $data       = [];
        $col_data   = DB::table('category')->lists('name');
        $id         = $request->input('id');
        $name       = $request->input('name');
        $parent_key = $request->input('parent_key') ? $request->input('parent_key') : 0;
        $ordinal    = $request->input('ordinal') ? $request->input('ordinal') : 0;
        $active     = $request->input('active');
        if(!is_numeric($ordinal)) {
            $this->error = true;
            $this->error_message = 'Thứ tự phải là số !';
            goto next;
        }
        if(isset($name) && !empty($name)) {
            if(!$id) {
                $data = $this->_add($name, $parent_key, $ordinal, $active, $col_data);
            } else {
                $data = $this->_update($id, $name, $parent_key, $ordinal, $active);
            }
        } else {
            $this->error = true;
            $this->error_message = 'Vui lòng nhập các đầy đủ các trường bắt buộc';
            goto next;
        }
        next:
        return $this->ResponseData($data);
    }

    private function _update($id, $name, $parent_key, $ordinal, $active) {
        try {
            $data = 
            [
                'name'       => $name,
                'parent_key' => $parent_key,
                'ordinal'    => $ordinal,
                'active'     => $active,
            ];
            $affectedRows = Category::where('id', '=', $id)->update($data);
            if($affectedRows) {
                $this->message = 'Sửa danh mục thành công';
            } else {
                $this->error_message = 'Error !';
                $this->error         = true;
            }   
        } catch (Exception $e) {
            $this->error_message = $e->getMessage();
            $this->error         = true;    
        }
        return $data;
    }

    private function _add($name, $parent_key, $ordinal, $active, $col_data) {
        try {
            if(in_array($name,$col_data)) {
                $this->error = true;
                $this->error_message = 'Tên danh mục đã tồn tại';
            } else {
                $Category              = new Category;
                $Category->name        = $name;
                $Category->create_time = date("Y-m-d H:i:s");
                $Category->parent_key  = $parent_key;
                $Category->ordinal     = $ordinal;
                $Category->active      = $active ? $active : 2; //1 is active and 2 is non active category
                $rs                    = $Category->save();
                $LastInsertId          = $Category->id;
                $data = 
                [
                    'id'          => $LastInsertId,
                    'name'        => $name,
                    'create_time' => date("Y-m-d H:i:s"),
                    'parent_key'  => $parent_key,
                    'ordinal'     => $ordinal
                ];
                $this->message = 'Thêm danh mục thành công !';
                return $data;
            }
        } catch (Exception $e) {
            $this->message = $e->getMessage();
            $this->error   = true;
        }
        
    }

    public function postUpdate(Request $request) {
        $dataRq = $request->input('data');

        foreach ($dataRq as $k => $data) {
            $id_parent = $data['item']['id'];
            DB::table('category')->where('id', $id_parent)->update(['parent_key' => 0]);

            if(isset($data['children'])) {
                foreach ($data['children'] as $item) {
                    $child_id =  $item['item']['id'];
                    $rs       = DB::table('category')->where('id', $child_id)->update(['parent_key' => $id_parent]);
                }
            }

        }
        $this->message = 'Update Complete';
        return $this->ResponseData();
    }

    public function postDelbyid(Request $request) {
        $id = $request->input('id');
        if(!$id) {
            $this->error = false;
            $this->error_message = 'Error , please submit again !';
            goto next;
        }
        try {
            $obj = Category::find($id);
            $obj->delete();
            $this->message = 'Xóa danh mục thành công !';
        } catch (Exception $e) {
            $this->error         = false;
            $this->error_message = $e->getMessage();
        }
        next:
        return $this->ResponseData();

    }
}
