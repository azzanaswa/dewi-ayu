<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blog;
use App\Panduan;
use App\Gallery;
use App\Divisi;
use App\Tag;
use App\Background;
use App\LowonganKerja;
use App\CategoryLoker;

class ProfileLandingPageController extends Controller
{   
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(6);
        $galleries = Gallery::orderBy('created_at', 'asc')->limit(12)->get();
        $bg = Background::where('category', 'LIKE', '%Home Slider%')->orderBy('created_at', 'desc')->limit(5)->get();
        $divisi = Divisi::orderBy('title', 'asc')->limit(6)->get();
        $catLoker = CategoryLoker::limit(6)->get();

        return view('profile.blog', compact('blogs', 'galleries', 'bg', 'divisi', 'catLoker'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gallery()
    {   
        $gallerys = Gallery::orderBy('created_at', 'asc')->paginate(12);

        return view('profile.gallery', compact('gallerys'));
    }

    public function panduan()
    {   
        $panduans = Panduan::orderBy('created_at', 'asc')->get();

        return view('profile.panduan', compact('panduans'));
    }

    public function blog()
    {   
        $blogs = Blog::orderBy('created_at', 'asc')->paginate(12);

        return view('profile.blog-grid', compact('blogs'));
    }

    public function visiMisi()
    {
        return view('profile.visi-misi');
    }

    public function organisasi()
    {
        return view('profile.organisasi');
    }

    public function document()
    {   
        $panduans = Panduan::orderBy('created_at', 'asc')->get();
        return view('profile.document', compact('panduans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $blogs = Blog::where('slug', $slug)->first();
        $tags = Tag::all();
        $events = Blog::orderBy('created_at', 'asc')->limit(4)->get();

        return view('profile.single-blog', compact('blogs', 'tags', 'events'));
    }

    public function divisiShow($slug)
    {
        $divisis= Divisi::where('slug', $slug)->first();

        return view('profile.divisi-detail', compact('divisis'));
    }

    public function programKerja()
    {
        return view('profile.programKerja');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function loker()
    {
        $lokers = LowonganKerja::orderBy('created_at', 'asc')->paginate(12);

        return view('profile.loker', compact('lokers'));
    }

    public function lokerShow($slug)
    {
        $lowongans = LowonganKerja::where('slug', $slug)->first();
        $categories = CategoryLoker::all();
        $lowongan_serupa = LowonganKerja::where('cat_id','LIKE','%' .$lowongans->cat_id. '%')->where('id', '!=', $lowongans->id)->get();

        return view('profile.single-loker', compact('lowongans', 'categories', 'lowongan_serupa'));
    }
}
