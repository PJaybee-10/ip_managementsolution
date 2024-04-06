<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Model\IpAddress;
use App\Model\Logs;
use DB;

class IpAddressController extends Controller
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

    public function index(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $length = 10;
        $start = $request->start ? $request->start : 0;
        $val = $request->searchTerm;
        if ($val != '' || $start > 0) {
            $data = DB::connection('mysql')->select("select * from ipaddress  where ip_address like '%" . $val . "%' or  description like '%" . $val . "%' LIMIT $length offset $start");
            $count = DB::connection('mysql')->select("select * from ipaddress  where ip_address like '%" . $val . "%' or  description like '%" . $val . "%' ");
        } else {
            $data = DB::connection('mysql')->select("select * from ipaddress LIMIT $length");
            $count = DB::connection('mysql')->select("select * from ipaddress");
        }

        $count_all_record = DB::connection('mysql')->select("select count(*) as count from ipaddress");

        $data_array = array();

        foreach ($data as $key => $value) {
            $arr = array();
            $arr['id'] = $value->id;
            $arr['ipaddress'] = $value->ip_address;
            $arr['desc'] = $value->description;
            $data_array[] = $arr;
        }
        $page = sizeof($count) / $length;
        $getDecimal = explode(".", $page);
        $page_count = round(sizeof($count) / $length);
        if (sizeof($getDecimal) == 2) {
            if ($getDecimal[1] < 5) {
                $page_count = $getDecimal[0] + 1;
            }
        }
        $datasets = array(
            
                "data" => $data_array,
                "count" => $page_count,
                "showing" =>
                    sizeof($count_all_record) > 0 ?
                    "Showing " . (($start + 10) - 9) . " to " . ($start + 10 > $count_all_record[0]->count ?
                        $count_all_record[0]->count :
                        $start + 10) . " of " . $count_all_record[0]->count : '',
                "patient" => $data_array
            
        );
        return response()->json($datasets);
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $p = new IpAddress;
        $p->ip_address = $request->ipaddress;
        $p->description = $request->comments;
        $p->created_by = auth()->id();
        $p->created_dt = date('Y-m-d');
        $p->save();

        $l = new Logs;
        $l->action =  auth()->user()->name.' add ip address '. $request->ipaddress.' @ '.date("F j, Y H:i:s");
        $l->save();
        return response()->json(['message' => 'Saved successfully.'], 200);
    }

    public function edit($id)
    {
        $data = IpAddress::where(['id' => $id])->first();
        return response()->json($data);
    }

    public function update(Request $request)
    {
        IpAddress::where(['id' => $request->ipadd_id])->update([
            'ip_address' => $request->ipaddress,
            'description' => $request->comments,
            'updated_by' => auth()->id(),
            'updated_dt' => date('Y-m-d'),
        ]);
        return response()->json(['message' => 'Updated successfully.'], 200);
    }

    public function Delete($id)
    {
        IpAddress::where('id', $id)->delete();
        return true;
    }

}
