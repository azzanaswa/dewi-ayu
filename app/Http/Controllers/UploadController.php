<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Validasi;
use App\Pelajaran;
use App\Jenjang;
use Auth;
use App\User;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Gate;
use GuzzleHttp\Client;

class UploadController extends Controller
{   

    public function validasi()
    {   
        if (! Gate::allows('can_guru')) {
            return abort(401);
        }

        $jenjang = Jenjang::all();
        $pelajaran = Pelajaran::orderBy('nama', 'asc')->get();

        return view('validasi', compact('jenjang', 'pelajaran'));
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeValidasi(Request $request)
    {   

        if (! Gate::allows('can_guru')) {
            return abort(401);
        }

        $request->validate([
            'file' => 'required|image|max:2000',
            'image' => 'required|image|max:2000',
            'ijazah' => 'required|image|max:2000',
            'alamat' => 'required',
        ]);

        $validasis = new Validasi;
        $validasis->user_id = Auth::user()->id;
        $validasis->nama = $request->nama;
 
        if($request->hasFIle('file')){
            $file = $request->file('file');
            $fileName = time().'.'.$file->getClientOriginalName();
            $destinationPath = public_path('/validasi_files');
            $file->move($destinationPath, $fileName);
            $validasis->file = $fileName;
        }

        if($request->hasFIle('image')){
            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalName();
            $destinationPath = public_path('/validasi_files');
            $file->move($destinationPath, $fileName);
            $validasis->image = $fileName;
        }

        if($request->hasFIle('ijazah')){
            $file = $request->file('ijazah');
            $fileName = time().'.'.$file->getClientOriginalName();
            $destinationPath = public_path('/validasi_files');
            $file->move($destinationPath, $fileName);
            $validasis->ijazah = $fileName;
        }

        $validasis->alamat = $request->alamat;

        if($request->has('alamat'))
        {
            $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
            $alamat = $request->alamat;
            $result = $client->post("https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyDFQJh_ua5ec9W1QRHe3QGZlIB4JvZeYNw&address=$alamat&region=id", [ 'form_params' => ['key'=>'AIzaSyDFQJh_ua5ec9W1QRHe3QGZlIB4JvZeYNw']])->getBody();
            $json =json_decode($result);
            $lat =$json->results[0]->geometry->location->lat;
            $lng =$json->results[0]->geometry->location->lng;
        }

        $validasis->phone = "62".$request->phone;

        $validasis->lat = $lat;
        $validasis->lng = $lng;

        $validasis->save();
        $validasis->jenjang()->sync($request->jenjang);
        $validasis->pelajaran()->sync($request->pelajaran);
        
        return back()->withInfo('Terima Kasih Telah Melakukan Validasi, Admin Akan Mereview Data Anda Terlebih Dahulu');
    }

    public function editValidasi($id)
    {
        if (! Gate::allows('can_guru')) {
            return abort(401);
        }

        $jenjang = Jenjang::all();
        $pelajaran = Pelajaran::orderBy('nama', 'asc')->get();
        $guru = Validasi::where('id', $id)->where('user_id', Auth::user()->id)->first();

        return view('editValidasi', compact('guru', 'jenjang', 'pelajaran'));
    }

    public function updateValidasi(Request $request, $id)
    {   

        if (! Gate::allows('can_guru')) {
            return abort(401);
        }

        $request->validate([
            'file' => 'required|image|max:2000',
            'image' => 'required|image|max:2000',
            'ijazah' => 'required|image|max:2000',
            'alamat' => 'required',
        ]);

        $validasis = Validasi::where('id', $id)->first();
        $validasis->user_id = Auth::user()->id;
        $validasis->nama = $request->nama;
 
        if($request->hasFIle('file')){
            $file = $request->file('file');
            $fileName = time().'.'.$file->getClientOriginalName();
            $destinationPath = public_path('/validasi_files/file');
            $file->move($destinationPath, $fileName);
            $validasis->file = $fileName;
        }

        if($request->hasFIle('image')){
            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalName();
            $destinationPath = public_path('/validasi_files/foto');
            $file->move($destinationPath, $fileName);
            $validasis->image = $fileName;
        }

        if($request->hasFIle('ijazah')){
            $file = $request->file('ijazah');
            $fileName = time().'.'.$file->getClientOriginalName();
            $destinationPath = public_path('/validasi_files/ijazah');
            $file->move($destinationPath, $fileName);
            $validasis->ijazah = $fileName;
        }

        $validasis->alamat = $request->alamat;

        if($request->has('alamat'))
        {
            $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
            $alamat = $request->alamat;
            $result = $client->post("https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyDFQJh_ua5ec9W1QRHe3QGZlIB4JvZeYNw&address=$alamat&region=id", [ 'form_params' => ['key'=>'AIzaSyDFQJh_ua5ec9W1QRHe3QGZlIB4JvZeYNw']])->getBody();
            $json =json_decode($result);
            $lat =$json->results[0]->geometry->location->lat;
            $lng =$json->results[0]->geometry->location->lng;
        }

        $validasis->phone = $request->phone;

        $validasis->lat = $lat;
        $validasis->lng = $lng;

        $validasis->save();
        $validasis->jenjang()->sync($request->jenjang);
        $validasis->pelajaran()->sync($request->pelajaran);
        
        return back()->withInfo('Terima Kasih Telah Melakukan Validasi, Admin Akan Mereview Data Anda Terlebih Dahulu');
    }

    public function penawaran()
    {
        $penawaran = Order::where('guru_id', Auth::user()->validasiGuru->id)->where('status', '==', 'success')->where('acc_admin',1)->get();

        return view('penawaranGuru', compact('penawaran'));
    }

}
