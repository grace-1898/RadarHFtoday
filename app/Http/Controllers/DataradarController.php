<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use App\data_radar;
use Carbon\Carbon;
 
class DataradarController extends Controller
{
 
    public function dataradar()
    {
        $dataradar = data_radar::all();
        return view('dataradar', ['dataradar' => $dataradar]);
    }
 
    public function getAll()
    {
        $data = data_radar::all();
 
        if (count($data) > 0) {
            $res['message'] = "Success!";
            $res['values'] = $data;
            return response($res);
        } else {
            $res['message'] = "Failed!";
            return response($res);
        }
    }
 
    public function getbylatlang(Request $request, $jam, $hari)
    {
        // http://localhost/dataradar/getbylatlang/{jam}/{hari}?lat={lat}&lon=$lon}
        $lokasi =  $request->query('lat') . ', ' . $request->query('lon');
        /* $parameter = $request->query('parameter'); */
        
        $data = data_radar::where('lokasi', $lokasi)->where('tanggal', Carbon::parse($hari)->format('Y-m-d'))->where('jam', Carbon::parse($jam)->format('H:i:s'))->first();
        $res['message'] = "Success!";
        $res['dataradar'] = $data;
        return response($res);
    }
}
 

