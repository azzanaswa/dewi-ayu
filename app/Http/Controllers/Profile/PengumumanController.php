<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Pengumuman;
use Auth;
use Alert;
use Image;
use Storage;

class PengumumanController extends Controller
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
        $pengumumans = Pengumuman::orderBy('created_at', 'desc')->get();

        return view('profile.pengumuman.index', compact('pengumumans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profile.pengumuman.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $pengumuman = new Pengumuman;
        $pengumuman->user_id = Auth::user()->id;
        $pengumuman->title = $request->title;
        $pengumuman->slug = str_slug($pengumuman->title);
        $pengumuman->content = $request->content;

        if ($request->has('image')) {
            $file = $request->file('image');
            $fileName = time().'-'.$file->getClientOriginalName();
            $destinationPath = public_path('profile_pmw/pengumuman/' .$fileName);

            Image::make($file->getRealPath())->resize(1300, 850)->save($destinationPath);

            $pengumuman->image = $fileName;
        }

        if ($request->has('file')) {
            $file = $request->file('file');
            $fileName = time().'-'.$file->getClientOriginalName();
            $destinationPath = public_path('profile_pmw/pengumuman/file/' .$fileName);

            $file->move($destinationPath, $fileName);

            $pengumuman->file = $fileName;
        }

        if (empty($request->title)) {
            alert()->warning('Mohon Maaf, Postingan Anda Gagal. Silahkan Periksa Kembali, dan Pastikan Judul Tidak Dikosongi')->persistent('Close');
            return back();
        }
        else{
            $pengumuman->save();

            alert()->success('Selamat! Postingan Baru Telah Berhasil di Buat, oleh ' .Auth::user()->name)->persistent('Close');
             return redirect()->route('admin.pengumumans.index');

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
        $pengumumans = Pengumuman::where('id', $id)->first();
    
        return view('profile.pengumuman.edit', compact('pengumumans'));
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

        $pengumuman = Pengumuman::where('id', $id)->first();
        $pengumuman->user_id = Auth::user()->id;
        $pengumuman->title = $request->title;
        $pengumuman->slug = str_slug($pengumuman->title);
        $pengumuman->content = $request->content;

        if ($request->has('image')) {
            $file = $request->file('image');
            $fileName = time().'-'.$file->getClientOriginalName();
            $destinationPath = public_path('profile_pmw/pengumuman/' .$fileName);

            Image::make($file->getRealPath())->resize(1300, 850)->save($destinationPath);

            $pengumuman->image = $fileName;
        }
        else{
            $pengumuman->image = $pengumuman->image;
        }

        if ($request->has('file')) {
            $file = $request->file('file');
            $fileName = time().'-'.$file->getClientOriginalName();
            $destinationPath = public_path('profile_pmw/pengumuman/file/' .$fileName);

            $file->move($destinationPath, $fileName);

            $pengumuman->file = $fileName;
        }
        else{
            $pengumuman->file = $pengumuman->file;
        }

        if (empty($pengumuman->title) ) {
            alert()->warning('Mohon Maaf, Postingan Anda Gagal. Silahkan Periksa Kembali, dan Pastikan Judul Tidak Dikosongi')->persistent('Close');
            return back();
        }
        else{
            $pengumuman->save();

            Alert::success('Selamat! Postingan dengan Judul '.$pengumuman->title.' Telah Berhasil di Rubah')->persistent('Close');
            return redirect()->route('admin.pengumumans.index');

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
        $pengumuman = Pengumuman::find($id);

        if ($pengumuman->image != NULL) {
            Storage::delete($pengumuman->image);
        }

        $pengumuman->delete();

            alert()->success('Post dengan Judul  ' .$pengumuman->title.' Telah Berhasil di Hapus', 'Sukses!')->autoclose('5000');
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
            $entries = Pengumuman::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                if ($entry->image != NULL) {
                    Storage::delete($entry->image);
                }
                
                $entry->delete();
            }

            alert()->success('Total ' .count($request->input('ids')).' Post Blog Telah Berhasil di Hapus', 'Sukses!')->autoclose('5000');
            return back();
        }
    }

}
