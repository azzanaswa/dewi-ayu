<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Tag;
use App\Blog;
use Auth;
use Alert;

class TagController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $tags = Tag::orderBy('id','ASC')->get();
        return view('profile.tags.index', compact('tags'));
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
        $request->validate([
            'title'=>'required',
        ]);

        $tags = new Tag;
        $tags->title = $request->title;

        if (empty($request->title) || Tag::where('title', 'LIKE', '%'.$request->title.'%')->exists()) {
            alert()->warning('Mohon Maaf, Tag Gagal di Buat. Silahkan Periksa Kembali, dan Pastikan Nama Tag Tidak Dikosongi', 'Gagal!')->autoclose('5000');
            return back();
        }
        else{
            $tags->save();

            alert()->success('Selamat! Tag Baru Telah Berhasil di Buat, oleh ' .Auth::user()->name.'.', 'Sukses!')->autoclose('5000');
            return back();
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
        $tags = Tag::orderBy('id','desc')->paginate(4);
        $tags2 = Tag::find($id);
        $posts = Blog::all();
        
        //return view('profile.admin.tags.index', compact('tags', 'tags2', 'posts'));
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
            'name_tags' => 'required',
        ]);

        $tags = Tag::where('id', $id)->first();
        $tags->title = $request->title;

        if (empty($request->title) || Tag::where('title', 'LIKE', '%'.$request->title.'%')->exists()) {
            alert()->warning('Mohon Maaf, Tag Gagal di Buat. Silahkan Periksa Kembali, dan Pastikan Nama Tag Tidak Dikosongi', 'Gagal!')->autoclose('5000');
            return back();
        }
        else{
            $tags->save();

            alert()->success('Selamat! Tag Baru Telah Berhasil di Buat, oleh ' .Auth::user()->name.'.', 'Sukses!')->autoclose('5000');
            return back();
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
        $tags = Tag::find($id);

        $tags->delete();

        alert()->success('Tag ' .$tags->title.' Telah Berhasil di Hapus', 'Sukses!')->autoclose('5000');
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
            $entries = Tag::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }

            alert()->success('Total ' .count($entries).' Tag Telah Berhasil di Hapus', 'Sukses!')->autoclose('5000');
            return back();
        }

    }
}
