<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Jenjang;
use App\Pelajaran;
use Auth;
use Session;
use App\Validasi;


class HomeController extends Controller
{   
    public function __construct()
    {

    }

    public function pilihJenjang()
    {   
        if (! Gate::allows('can_user')) {
            return abort(401);
        }

        $jenjang = Jenjang::all();

        return view('kelas', compact('jenjang'));
    }

    //get
    public function pilihPelajaran(Request $request)
    {   
        if (! Gate::allows('can_user')) {
            return abort(401);
        }

        $pelajaran = Pelajaran::all();
        $request->session()->put('jenjang_pilihan', $request->jenjang);
        $jenjang_opsi2 = Session::get('jenjang_pilihan');

        return view('pelajarans', compact('pelajaran', 'lat', 'lng'));

    }

    //get opsi 1
    public function getGuru(Request $request)
    {   
        if (! Gate::allows('can_user')) {
            return abort(401);
        }

        // //sessions and query request
        // $query = $request->query();
        // $new = json_decode($query, true);
        // $jenjang_opsi2 = $new['jenjang'];
        $jenjang_opsi = Session::get('jenjang_pilihan');

        if ($request->input('ids')) {

                $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
                $alamat = $request->alamat;
                $result = $client->post("https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyDFQJh_ua5ec9W1QRHe3QGZlIB4JvZeYNw&address=$alamat&region=id", [ 'form_params' => ['key'=>'AIzaSyDFQJh_ua5ec9W1QRHe3QGZlIB4JvZeYNw']])->getBody();
                $json =json_decode($result);
                $lat =$json->results[0]->geometry->location->lat;
                $lng =$json->results[0]->geometry->location->lng;

                $request->session()->put('lat', $json->results[0]->geometry->location->lat);
                $request->session()->put('lng', $json->results[0]->geometry->location->lng);
                
            //first query
            $gurus = Validasi::whereBetween('lat',[$lat-0.1,$lat+0.1])->whereBetween('lng',[$lng-0.1,$lng+0.1])->where('status', 1);
            //second query
            $entries = $gurus->whereHas('jenjang', function($query) use($jenjang_opsi){
                $query->where('jenjangs.nama', $jenjang_opsi);
            });
            //third query
            $guru = $entries->whereHas('pelajaran', function($query) use($request){
                $query->where('pelajarans.nama', $request->input('ids'));
            })->get();

            $request->session()->put('pelajaran_pilihan', $request->input('ids'));
        }

        if (count($guru) > 0) {
            
            $alamatSiswa =$request->alamat;
            $remFrom = str_replace(',', '', $alamatSiswa);
            $from = urlencode($remFrom);

            /**
            * @param $form, $to
            * @return $hasil
            * @query SELECT *, 
                    ( 6371 * acos( cos( radians($to) ) 
                    * cos( radians( lat ) ) 
                    * cos( radians( lng ) - radians($from[lng]) ) + sin( radians($from[lat]) ) 
                    * sin( radians( lat ) ) ) ) 
                    AS calculated_distance 
                    FROM validasis as T 
                    HAVING calculated_distance <= (SELECT distance FROM validasis WHERE id=T.id) 
                    Get
            */
                    
        }

        if($request->ajax()){
            return response()->json($guru);
        }

        return view('cari', compact('guru', 'jarak', 'from', 'waktu', 'lat', 'lng', 'data'));
    }

        /**
         * Show the application dashboard.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {   
            return view('home');
        }

        public function about()
        {
            return view('about');
        }
        
        public function contact()
        {
            return view('contact');
        }

    public function pembayaran()
    {   
        if (! Gate::allows('can_user')) {
            return abort(401);
        }   

        return view('pembayaran');
    }

    public function fetchGuru(Request $request)
    {
        $lat=$request->lat;
        $lng=$request->lng;
        $guru = Validasi::whereBetween('lat',[$lat-0.1,$lat+0.1])->whereBetween('lng',[$lng-0.1,$lng+0.1])->get();
        return response()->json($guru);
    }

    public function userCoords(Request $request)
    {
        $lat=$request->lat;
        $lng=$request->lng;

        return [$lat,$lng];
    }
        
}
