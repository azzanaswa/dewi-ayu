<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use App\Divisi;
use App\Background;
use App\Proker;
use App\StrukturOrganisasi;
use App\VisiMisi;
use Alert;
use Storage;
use Image;
use Auth;

class ExtraContentController extends Controller
{
    public function backgroundIndex()
    {
    	$backgorund = Background::orderBy('created_at', 'desc')->get();

    	return view('profile.extra.backgroundIndex', compact('backgorund'));
    }

    public function backgroundStore(Request $request)
    {
    	$background = new Background;
    	$background->category = $request->category;
        $background->title = $request->title;
        $background->caption = $request->caption;


    	if ($request->hasFile('image') && Str::contains($background->category, 'Home Slider')) {
    		$file = $request->file('image');
    		$fileName = time().$file->getClientOriginalName();
    		$destinationPath = public_path('profile_pmw/' .$fileName);

    		Image::make($file->getRealPath())->resize(1920, 1000)->save($destinationPath);
    		$background->image = $fileName;
    	}


    	if (empty($request->title) || empty($request->image) ) {
            alert()->warning('Mohon Maaf, Background yang Anda Tambahkan Gagal. Silahkan Periksa Kembali, dan Pastikan Foto Background Tidak Dikosongi', 'Gagal!')->persistent('Close');
            return back();
        }
        else{
            $background->save();

            alert()->success('Selamat! Background ' .$background->category.' Telah Berhasil di Tambahkan', 'Berhasil!')->persistent('Close');
             return back();

        }
    }

    public function updateBackground(Request $request, $id)
    {
    	$background = Background::where('id', $id)->first();
    	$background->category = $request->category;
        $background->title = $request->title;
        $background->caption = $request->caption;

    	if ($request->hasFile('image') && Str::contains($request->category, 'Home Slider')) {
    		$file = $request->file('image');
    		$fileName = time().$file->getClientOriginalName();
    		$destinationPath = public_path('profile_pmw/' .$fileName);

    		Image::make($file->getRealPath())->resize(1920, 1000)->save($destinationPath);
    		$background->image = $fileName;
    	}
    	else{
    		$background->image = $background->image;
    	}

    	if (empty($request->title) || empty($request->image) ) {
            alert()->warning('Mohon Maaf, Background yang Anda Tambahkan Gagal. Silahkan Periksa Kembali, dan Pastikan Foto Background Tidak Dikosongi', 'Gagal!')->persistent('Close');
            return back();
        }
        else{
            $background->save();

            alert()->success('Selamat! Background ' .$background->category.' Telah Berhasil di Tambahkan', 'Berhasil!')->persistent('Close');
            return back();
        }
    }

    public function destroyBackground($id)
    { 
        $background = Background::find($id);
        Storage::delete($background->image);

        $background->delete();

            alert()->success('Background ' .$background->category.' Telah Berhasil di Hapus', 'Sukses!')->autoclose('5000');
            return back();
    }
    
}
