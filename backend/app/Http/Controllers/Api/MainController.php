<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Providers;

class MainController extends Controller
{
    
    public function __construct()
    {
        
    }
    public function getIndex(){
        return response()->json(
            [
                'message' => 'Welcome to MainController'
            ]
        );
    }

    public function getProviders(){
        $model      = new Providers;
        $providers  = $model->getData();

        $this->error_message = "Thành công";
        return $this->ResponseData($providers);
    }
}
