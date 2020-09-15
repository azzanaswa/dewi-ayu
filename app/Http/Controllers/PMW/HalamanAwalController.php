<?php

namespace App\Http\Controllers\PMW;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Gallery;
use App\Panduan;
use App\Pengumuman;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail;

class HalamanAwalController extends Controller
{
    public function contact()
    {
    	return view ('pmw3blade.contact');
    }

    public function galeri()
    {   
        $galeries = Gallery::orderBy('created_at', 'asc')->get();
        return view('pmw3blade.galeri', compact('galeries'));
    }
 public function showGaleri($slug)
    {   
        $galeries = Gallery::where('slug', 'LIKE', '%'.$slug.'%')->first();
        return view('pmw3blade.foto', compact('galeries'));
    }

    
    public function home()
    {
    	return view ('pmw3blade.home');
    }
    public function panduan()
    {   
        $panduans = Panduan::orderBy('created_at', 'desc')->get();
    	return view ('pmw3blade.panduan', compact('panduans'));
    }

	public function pengumuman()
    {
    	$pengumumans = Pengumuman::orderBy('created_at', 'desc')->get();
    	return view('pmw3blade.pengumuman', compact('pengumumans'));
    }

    public function showPengumuman($slug)
    {
        $pengumumans = Pengumuman::where('slug', 'LIKE', '%'.$slug.'%')->first();
        return view('pmw3blade.bacapengumuman', compact('pengumumans'));
    }

    public function sendMail(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required|email',
            'title' => 'required',
            'body' => 'required',
        ]);

        $data = array(
            'nama' => $request->nama,
            'email' => $request->email,
            'title' => $request->title,
            'body' => $request->body,
        );

        Mail::to('dewitiwi14@gmail.com')->send(new ContactUsMail($data));

        alert()->success('Berhasil', 'Terima Kasih telah menghubungi kami!')->persistent('Close');
        return back();
    }
}
