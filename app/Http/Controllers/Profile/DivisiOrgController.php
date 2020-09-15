<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Divisi;
use App\DivisiOrg;
use Alert;
use Auth;
use Storage;
use Image;

class DivisiOrgController extends Controller
{   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');      
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $orgs = DivisiOrg::orderBy('created_at', 'asc')->get();

        return view('profile.divisi-org.index', compact('orgs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisis = Divisi::orderBy('title', 'asc')->get()->pluck('title', 'id');

        return view('profile.divisi-org.create', compact('divisis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $org = new DivisiOrg;
        $org->divisi_id = $request->divisi_id;
        $org->title = $request->title;
        $org->link = $request->link;
        $org->content = $request->content;

        if ($request->has('images')) {
            $file = $request->file('images');
            $fileName = time().'-'.$file->getClientOriginalName();
            $destinationPath = public_path('profile/extra/divisi/organisasi/' .$fileName);

            Image::make($file->getRealPath())->resize(1300, 850)->save($destinationPath);
            $org->image = $fileName;
        }


        if (empty($request->title) || empty($request->images) ) {
            alert()->warning('Mohon Maaf, Postingan Anda Gagal. Silahkan Periksa Kembali, dan Pastikan Judul serta Gambar Tidak Dikosongi')->persistent('Close');
            return back();
        }
        else{
            $org->save();

            alert()->success('Selamat! Postingan anda Berhasil di Buat, oleh ' .Auth::user()->name)->persistent('Close');
             return redirect()->route('admin.divisi-org.index');

        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orgs = DivisiOrg::where('id', $id)->first();
        $divisis = Divisi::orderBy('title', 'asc')->get()->pluck('title', 'id');

        return view('profile.divisi-org.edit', compact('orgs', 'divisis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {      
        $request->validate([
            'image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048',
        ]);

        $blogs = Blog::where('id', $id)->first();
        $org->divisi_id = $request->divisi_id;
        $org->title = $request->title;
        $org->link = $request->link;
        $org->content = $request->content;

        if ($request->has('images')) {
            $file = $request->file('images');
            $fileName = time().'-'.$file->getClientOriginalName();
            $destinationPath = public_path('profile/extra/divisi/organisasi/' .$fileName);

            Image::make($file->getRealPath())->resize(1300, 850)->save($destinationPath);
            $org->image = $fileName;
        }
        else{
            $org->image = $org->image;
        }


        if (empty($request->title) || empty($request->images) ) {
            alert()->warning('Mohon Maaf, Postingan Anda Gagal. Silahkan Periksa Kembali, dan Pastikan Judul serta Gambar Tidak Dikosongi')->persistent('Close');
            return back();
        }
        else{
            $org->save();

            alert()->success('Selamat! Postingan Anda Telah Berhasil di Buat, oleh ' .Auth::user()->name)->persistent('Close');
             return redirect()->route('admin.divisi-org.index');

        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        $orgs = DivisiOrg::find($id);
        Storage::delete($orgs->image);
       
        $orgs->delete();

            alert()->success('Divisi Organisasi  ' .$orgs->title.' Telah Berhasil di Hapus', 'Sukses!')->autoclose('5000');
            return back();
    }

    /**
     * Delete all selected at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = DivisiOrg::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                Storage::delete($entry->image);
                $entry->delete();
            }

            alert()->success('Total ' .count($request->input('ids')).' Divisi Organisasi Telah Berhasil di Hapus', 'Sukses!')->autoclose('5000');
            return back();
        }
    }

}
