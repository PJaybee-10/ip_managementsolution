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
        date_default_timezone_set('Asia/Manila');
    }

    public function index(Request $request)
    {
        $data = IpAddress::all();
        $data_array = array();
        foreach ($data as $key => $value) {
            $arr = array();
            $arr['id'] = $value->id;
            $arr['ipaddress'] = $value->ip_address;
            $arr['desc'] = $value->description;
            $data_array[] = $arr;
        }
        $datasets = array(
            "data" => $data_array,
        );
        return response()->json($datasets);
    }

    public function store(Request $request)
    {
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
        IpAddress::where(['id' => $request->id])->update([
            'ip_address' => $request->ipaddress,
            'description' => $request->comments,
            'updated_by' => auth()->id(),
            'updated_dt' => date('Y-m-d'),
        ]);

        $l = new Logs;
        $l->action =  auth()->user()->name.' update the comments/label of ip address '. $request->ipaddress.' to '.$request->comments.' @ '.date("F j, Y H:i:s");
        $l->save();
        return response()->json(['message' => 'Updated successfully.'], 200);
    }

    public function Delete($id)
    {
        IpAddress::where('id', $id)->delete();
        return true;
    }

}
