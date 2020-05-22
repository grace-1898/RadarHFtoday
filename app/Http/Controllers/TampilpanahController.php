<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use App\Tampilpanah;
use Carbon\Carbon;
 
class TampilpanahController extends Controller
{

    public function Tampilpanah()
    {
        $Tampilpanah = Tampilpanah::all();
        return view('tampilpanah', ['tampilpanah' => $tampilpanah]);
    }
 
    public function getAll()
    {
        $data1 = Tampilpanah::all();

        if (count($data1) > 0) {
            $res['message'] = "Success!";
            $res['values'] = $data1;
            return response($res);
        } else {
            $res['message'] = "Failed!";
            return response($res);
        }
    }

    public function gettampilpanah(Request $request, $jam, $hari)
    {
        // $jam = $request->query('jam');
        // $hari = $request->query('hari');
        $data = tampilpanah::where('tanggal', Carbon::parse($hari)->format('Y-m-d'))->where('jam', Carbon::parse($jam)->format('H:i:s'))->get();
        $res['message'] = "Success!";
        $res['tampilpanah'] = $data;
        return response($res);
    }
}
 
