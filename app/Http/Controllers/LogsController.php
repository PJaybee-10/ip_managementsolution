<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Model\Logs;
use DB;

class LogsController extends Controller
{  
    
    /**
    * Create a new AuthController instance.
    *
    * @return void
    */
   public function __construct()
   {
       $this->middleware('JWT');
   }

    public function report(Request $request)
    {
        $data = Logs::all();
        $data_array = array();
        foreach ($data as $key => $value) {
            $arr = array();
            $arr['action'] =  $value->action;
            $data_array[] = $arr;
        }
        return response()->json($data_array);
    }
}
