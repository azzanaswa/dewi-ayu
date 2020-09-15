<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Tag;
use App\Blog;
use Auth;
use Alert;
use Image;
use Storage;

class BlogController extends Controller
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
        $blogs = Blog::orderBy('created_at', 'asc')->get();
        $tags = Tag::orderBy('title', 'asc')->get();

        return view('profile.blog.index', compact('blogs', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::orderBy('title', 'asc')->get()->pluck('title', 'id');

        return view('profile.blog.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $blogs = new Blog;
        $blogs->user_id = Auth::user()->id;
        $blogs->title = $request->title;
        $blogs->slug = str_slug($blogs->title);
        $blogs->content = $request->content;

        if ($request->has('images')) {
            $file = $request->file('images');
            $fileName = time().'-'.$file->getClientOriginalName();
            $destinationPath = public_path('profile/blog_images/' .$fileName);

            Image::make($file->getRealPath())->resize(1300, 850)->save($destinationPath);
            $blogs->image = $fileName;
        }


        if (empty($request->title) || empty($request->images) ) {
            alert()->warning('Mohon Maaf, Postingan Anda Gagal. Silahkan Periksa Kembali, dan Pastikan Judul serta Gambar Tidak Dikosongi')->persistent('Close');
            return back();
        }
        else{
            $blogs->save();

            $blogs->tags()->sync($request->tags); 

            alert()->success('Selamat! Postingan Baru Telah Berhasil di Buat, oleh ' .Auth::user()->name)->persistent('Close');
             return redirect()->route('admin.blogs.index');

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
        $blogs = Blog::where('id', $id)->first();
        $tags = Tag::orderBy('title', 'asc')->get()->pluck('title', 'id');

        return view('profile.blog.edit', compact('blogs', 'tags'));
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

        $blogs = Blog::where('id', $id)->first();
        $blogs->title = $request->title;
        $blogs->content = $request->content;
        $blogs->slug = str_slug($blogs->title);

        if ($request->has('image')) {
            $file = $request->file('image');
            $fileName = time().'-'.$file->getClientOriginalName();
            $destinationPath = public_path('profile/blog_images/' .$fileName);

            Image::make($file->getRealPath())->resize(1300, 850)->save($destinationPath);

            $blogs->image = $fileName;
        }
        else{
            $blogs->image = $blogs->image;
        }

        if (empty($blogs->title) || empty($blogs->image) ) {
            alert()->warning('Mohon Maaf, Postingan Anda Gagal. Silahkan Periksa Kembali, dan Pastikan Judul serta Gambar Tidak Dikosongi')->persistent('Close');
            return back();
        }
        else{
            $blogs->save();

            if ($request->has('tags')) {
                    $blogs->tags()->sync($request->tags);
                }
                else{
                    return true;
                }

            Alert::success('Selamat! Postingan dengan Judul '.$blogs->title.' Telah Berhasil di Rubah')->persistent('Close');
            return redirect()->route('admin.blogs.index');

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
        $blogs = Blog::find($id);
        Storage::delete($blogs->image);
        $blogs->tags()->detach();
        $blogs->delete();

            alert()->success('Post dengan Judul  ' .$blogs->title.' Telah Berhasil di Hapus', 'Sukses!')->autoclose('5000');
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
                $entry->tags()->detach();
                $entry->delete();
            }

            alert()->success('Total ' .count($request->input('ids')).' Post Blog Telah Berhasil di Hapus', 'Sukses!')->autoclose('5000');
            return back();
        }
    }

    public function uploadImageCKeditor(Request $request)
    {
        if($request->hasFile('admin.upload')) {

            $filenamewithextension = $request->file('admin.upload')->getClientOriginalName();
      
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('admin.upload')->getClientOriginalExtension();
            $filenametostore = $filename.'_'.time().'.'.$extension;
      
            $request->file('admin.upload')->storeAs('profile/public/profile/CKeditor/image/', $filenametostore);
 
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/CKeditor/image/'.$filenametostore); 
            $msg = 'Image successfully uploaded'; 
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
             
            @header('Content-type: text/html; charset=utf-8'); 
            //echo $re;
        }
    }
}
