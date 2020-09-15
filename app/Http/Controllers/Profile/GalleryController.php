<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gallery;
use Auth;
use Image;
use Storage;

class GalleryController extends Controller
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
        $gallerys = Gallery::orderBy('created_at', 'asc')->get();

        return view('profile.gallery.index', compact('gallerys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profile.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // $request->validate([
        //     'image' => 'image|mimes:jpg,png,jpeg,svg,gif|max:2048',
        // ]);

        if (empty($request->title) || empty($request->content)) {
                alert()->warning('Maaf, Terjadi Beberapa Kesalahan Saat Upload. Pastikan Judul dan Gambar tidak di Kosongi', 'Gagal!')->autoclose('5000');

            return back();
        }
        else{
            foreach($request->file('image') as $key => $img)
            {
                $gallerys = new Gallery;
                $gallerys->user_id = Auth::user()->id;
                $gallerys->title = $request->title [$key];
                $gallerys->slug = str_slug($request->title [$key]);
                $gallerys->content = $request->content [$key];

                if (!empty($img)) {
                    $fileName = time().'.'.$img->getClientOriginalName();
                    $destinationPath = public_path('profile_pmw/gallery/' .$fileName);

                    Image::make($img->getRealPath())->resize(1050, 600)->save($destinationPath);
                    $gallerys->image = $fileName;
                }
            
                    $gallerys->save();
            }
            alert()->success('Selamat, Anda Berhasil Menambahkan Gallery Baru', 'Berhasil!')->autoclose('5000');
                    return redirect()->route('admin.gallerys.index');
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
        $request->validate([
            'image' => 'image|mimes:jpg,png,jpeg,svg,gif|max:2048',
        ]);

        $gallerys = Gallery::where('id', $id)->first();
        $gallerys->user_id = Auth::user()->id;
        $gallerys->title = $request->title;
        $gallerys->slug = str_slug($request->title);
        $gallerys->content = $request->content;

        if ($request->has('image')) {
            $file = $request->file('image');
            $fileName = time().'-'.$file->getClientOriginalName();
            $destinationPath = public_path('profile_pmw/gallery/' .$fileName);

            Image::make($file->getRealPath())->resize(1050, 600)->save($destinationPath);

            $gallerys->image = $fileName;
        }
        else{
            $gallerys->image = $gallerys->image;
        }

        if (empty($gallerys->title) || empty($gallerys->image)) {
            alert()->warning('Maaf, Terjadi Kesalahan Saat Upload. Pastikan Judul dan Gambar tidak di Kosongi', 'Gagal!')->autoclose('5000');

            return back();
        }
        else{
            $gallerys->save();

            alert()->success('Selamat, Anda Berhasil Menambahkan Gallery Baru', 'Berhasil!')->autoclose('5000');
            return redirect()->route('admin.gallerys.index');
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
        $gallerys = Gallery::findOrFail($id);
        Storage::delete($gallerys->image);
        $gallerys->delete();

        alert()->success('Gallery dengan Judul  ' .$gallerys->title.' Telah Berhasil di Hapus', 'Sukses!')->autoclose('5000');
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
            $entries = Gallery::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                Storage::delete($entry->image);
                $entry->delete();
            }

            alert()->success('Total ' .count($entries).' Foto Gallery Telah Berhasil di Hapus', 'Sukses!')->autoclose('5000');
            return back();
        }
    }
}
