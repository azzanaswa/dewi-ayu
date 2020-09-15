<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Panduan;
use Auth;
use Storage;
use Alert;

class PanduanController extends Controller
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
        $panduans = Panduan::orderBy('created_at', 'asc')->get();

        return view('profile.panduan.index', compact('panduans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        if (empty($request->title) || empty($request->file)) {
                alert()->warning('Maaf, Terjadi Beberapa Kesalahan Saat Upload. Pastikan Judul dan File Panduan tidak di Kosongi', 'Gagal!')->autoclose('5000');

            return back();
        }
        else{
            foreach($request->file('file') as $key => $fl)
            {
                $panduans = new Panduan;
                $panduans->user_id = Auth::user()->id;
                $panduans->title = $request->title [$key];
                $panduans->slug = str_slug($panduans->panduans);
       
                if (!empty($fl)) {
                    $fileName = time().'-'.$fl->getClientOriginalName();
                    $destinationPath = public_path('/profile_pmw/panduan');
                    $fl->move($destinationPath, $fileName);

                    $panduans->file = $fileName;
                }
                    $panduans->save();
            }

            alert()->success('Selamat! Postingan Panduan Baru Telah Berhasil di Buat, oleh' .Auth::user()->name.'.', 'Berhasil!')->persistent('Close');
             return redirect()->route('admin.panduans.index');
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
        //
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
        $panduans = Panduan::where('id', $id)->first();
        $panduans->user_id = Auth::user()->id;
        $panduans->title = $request->title;
        $panduans->slug = str_slug($panduans->title);
       
        if ($request->has('file')) {
            $file = $request->file('file');
            $fileName = time().'-'.$file->getClientOriginalName();
            $destinationPath = public_path('/profile_pmw/panduan');
            $file->move($destinationPath, $fileName);

            $panduans->file = $fileName;
        }
        else{
            $panduans->file = $panduans->file;
        }

        if (empty($panduans->title) || empty($panduans->file) ) {
            alert()->warning('Mohon Maaf, Postingan Anda Gagal. Silahkan Periksa Kembali, dan Pastikan Judul serta File Tidak Dikosongi', 'Gagal!')->persistent('Close');
            return back();
        }
        else{
            $panduans->save();

            alert()->success('Selamat! Panduan dengan Id '.$panduans->id.' Telah Berhasil di Edit', 'Berhasil!')->persistent('Close');
             return redirect()->route('admin.panduans.index');

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
        $panduans = Panduan::findOrFail($id);
        Storage::delete($panduans->file);

        $panduans->delete();

        alert()->success('Panduan dengan Id ' .$panduans->id.' Telah Berhasil di Hapus', 'Sukses!')->autoclose('5000');
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
            $entries = Panduan::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                Storage::delete($entry->file);
                $entry->delete();
            }

            alert()->success('Total ' .count($entries).'Panduan PMW Telah Berhasil di Hapus', 'Sukses!')->autoclose('5000');
            return back();
        }
    }
    
    // public function downloadImage($id){
    //   $file = Book::where('id', $id)->firstOrFail();
    //   $path = '/profile/public/profile/panduan/'. $book_cover->filename;
    //   return response()->download($path, $book_cover
    //             ->original_filename, ['Content-Type' => $book_cover->mime]);
    // }
}
