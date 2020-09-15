<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CategoryLoker;
use Alert;

class CategoryLokerController extends Controller
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
        $catlokers = CategoryLoker::orderBy('title', 'asc')->get();

        return view('profile.category_loker.index', compact('catlokers'));
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
        $cat_lokers = new CategoryLoker;
        $cat_lokers->title = $request->title;
        $cat_lokers->slug = str_slug($request->title);

        if (!empty($cat_lokers)) {
            $cat_lokers->save();

            alert()->success('Kategori Lowongan Kerja dengan nama '.$cat_lokers->title. ' Telah berhasil di Tambahkan', 'Berhasil')->autoclose('5000');
            return back();
        }
        else{
            alert()->error('Kategori Lowongan Kerja Gagal Ditambahkan, Pastikan Nama Tidak Anda Kosongi', 'Gagal')->autoclose('5000');
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
        $cat_lokers = CategoryLoker::where('id', $id)->first();
        $cat_lokers->title = $request->title;
        $cat_lokers->slug = str_slug($request->title);

        if (!empty($cat_lokers)) {
            $cat_lokers->save();

            alert()->success('Kategori Lowongan Kerja dengan nama '.$cat_lokers->title. ' Telah berhasil di Edit', 'Berhasil')->autoclose('5000');
            return back();
        }
        else{
            alert()->error('Kategori Lowongan Kerja Gagal Ditambahkan, Pastikan Nama Tidak Anda Kosongi', 'Gagal')->autoclose('5000');
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
        $cat_lokers = CategoryLoker::findOrFail($id);

        $cat_lokers->delete();
        alert()->success('Kategori Lowongan Kerja dengan nama '.$cat_lokers->title. ' Telah berhasil di Hapus', 'Berhasil')->autoclose('5000');
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
            $entries = CategoryLoker::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }

            alert()->success('Total ' .count($request->input('ids')).' Kategori Lowongan Kerja Telah Berhasil di Hapus', 'Sukses!')->autoclose('5000');
            return back();
        }
    }
}
