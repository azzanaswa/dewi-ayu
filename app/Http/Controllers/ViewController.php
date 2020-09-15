<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Validasi;
use App\Jenjang;
use App\Pelajaran;
use Auth;

class ViewController extends Controller
{
    
    public function views($id){

    	$guru = Validasi::where('id', $id)->first();
    	
    	return view('view', compact('guru'));
    }

    public function guruLocationCoords(Request $request)
    {
        $val=$request->val;
        $col=Validasi::where('id',$val)->first();

        $lat=$col->lat;
        $lng=$col->lng;

        return [$lat,$lng];
    }
}
