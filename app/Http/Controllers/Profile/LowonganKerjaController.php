<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LowonganKerja;
use App\CategoryLoker;
use Storage;
use Image;
use Auth;

class LowonganKerjaController extends Controller
{   
    public function __construct()
    {
        return $this->middleware('auth');    
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lokers = LowonganKerja::orderBy('created_at', 'desc')->get();
        $catlokers = CategoryLoker::orderBy('title', 'asc')->get();

        return view('profile.loker.index', compact('catlokers', 'lokers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catlokers = CategoryLoker::orderBy('title', 'asc')->get()->pluck('title', 'id');

        return view('profile.loker.create', compact('catlokers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lokers = new LowonganKerja;
        $lokers->user_id = Auth::user()->id;
        $lokers->title = $request->title;
        $lokers->slug = str_slug($lokers->title);
        $lokers->content = $request->content;
        $lokers->cat_id = $request->cat_id;
        $lokers->perusahaan = $request->nama_perusahaan;
        $lokers->gaji = $request->gaji;
        $lokers->kontak_perusahaan = $request->cp;

        if ($request->has('image')) {
            $file = $request->file('image');
            $fileName = time().'-'.$file->getClientOriginalName();
            $destinationPath = public_path('profile/loker_image/images/' .$fileName);

            Image::make($file->getRealPath())->resize(1300, 850)->save($destinationPath);
            $lokers->image = $fileName;
        }

        if ($request->has('logo')) {
            $file2 = $request->file('logo');
            $fileName2 = time().'-'.$file2->getClientOriginalName();
            $destinationPath2 = public_path('profile/loker_image/logo_perusahaan/' .$fileName2);

            Image::make($file2->getRealPath())->resize(1300, 850)->save($destinationPath2);
            $lokers->logo_perusahaan = $fileName2;
        }


        if (empty($request->title) || empty($request->image) ) {
            alert()->warning('Mohon Maaf, Postingan Anda Gagal. Silahkan Periksa Kembali, dan Pastikan Judul serta Gambar Tidak Dikosongi')->persistent('Close');
            return back();
        }
        else if (empty($request->logo) || empty($request->nama_perusahaan)) {
            alert()->warning('Mohon Maaf, Postingan Anda Gagal. Silahkan Periksa Kembali, dan Pastikan Nama Perusahaan serta Logo Tidak Dikosongi')->persistent('Close');
            return back();
        }
        else{
            $lokers->save();

            alert()->success('Selamat! Lowongan Kerja Baru Telah Berhasil di Buat, oleh ' .Auth::user()->name)->persistent('Close');
             return redirect()->route('admin.lowongan-kerja.index');

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
        $lokers = LowonganKerja::where('id', $id)->first();
        $catlokers = CategoryLoker::orderBy('title', 'asc')->get()->pluck('title', 'id');

        return view('profile.loker.edit', compact('lokers', 'catlokers'));
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
        $lokers = LowonganKerja::where('id', $id)->first();
        $lokers->user_id = Auth::user()->id;
        $lokers->title = $request->title;
        $lokers->slug = str_slug($lokers->title);
        $lokers->content = $request->content;
        $lokers->cat_id = $request->cat_id;
        $lokers->perusahaan = $request->nama_perusahaan;
        $lokers->gaji = $request->gaji;
        $lokers->kontak_perusahaan = $request->cp;

        if ($request->has('image')) {
            $file = $request->file('image');
            $fileName = time().'-'.$file->getClientOriginalName();
            $destinationPath = public_path('profile/loker_image/images/' .$fileName);

            Image::make($file->getRealPath())->resize(1300, 850)->save($destinationPath);
            $lokers->image = $fileName;
        }
        else{
            $lokers->image = $lokers->image;
        }

        if ($request->has('logo')) {
            $file2 = $request->file('logo');
            $fileName2 = time().'-'.$file2->getClientOriginalName();
            $destinationPath2 = public_path('profile/loker_image/logo_perusahaan/' .$fileName2);

            Image::make($file2->getRealPath())->resize(1300, 850)->save($destinationPath2);
            $lokers->logo_perusahaan = $fileName2;
        }
        else{
            $lokers->logo_perusahaan = $lokers->logo_perusahaan;
        }


        if (empty($request->title) || empty($request->image) ) {
            alert()->warning('Mohon Maaf, Postingan Anda Gagal. Silahkan Periksa Kembali, dan Pastikan Judul serta Gambar Tidak Dikosongi')->persistent('Close');
            return back();
        }
        else if (empty($request->logo) || empty($request->nama_perusahaan)) {
            alert()->warning('Mohon Maaf, Postingan Anda Gagal. Silahkan Periksa Kembali, dan Pastikan Nama Perusahaan serta Logo Tidak Dikosongi')->persistent('Close');
            return back();
        }
        else{
            $lokers->save();

            alert()->success('Selamat! Lowongan Kerja Telah Berhasil di Update, oleh ' .Auth::user()->name)->persistent('Close');
             return redirect()->route('admin.lowongan-kerja.index');

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
        $lokers = LowonganKerja::find($id);
        Storage::delete($lokers->image);
        Storage::delete($lokers->logo_perusahaan);
        
        $lokers->delete();

            alert()->success('Lowongan Kerja dengan Judul  ' .$lokers->title.' Telah Berhasil di Hapus', 'Sukses!')->autoclose('5000');
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
            $entries = Blog::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                Storage::delete($entry->image);
                Storage::delete($entry->logo_perusahaan);
                
                $entry->delete();
            }

            alert()->success('Total ' .count($request->input('ids')).' Lowongan Kerja Telah Berhasil di Hapus', 'Sukses!')->autoclose('5000');
            return back();
        }
    }

}
