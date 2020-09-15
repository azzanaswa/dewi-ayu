<?php


Route::get('/', function () {
    return view('pmw3blade.home');
});

Auth::routes();
Route::get('kontak','PMW\HalamanAwalController@contact')->name('kontak');
Route::get('galeri','PMW\HalamanAwalController@galeri')->name('galeri');
Route::get('home','PMW\HalamanAwalController@home')->name('home');
Route::get('panduan','PMW\HalamanAwalController@panduan')->name('panduan');

Route::post('contact/store','PMW\HalamanAwalController@sendMail')->name('send.mail');

//route CRUD
Route::get('/pengumuman','PMW\HalamanAwalController@pengumuman')->name('pengumuman');
Route::get('/pengumuman/{slug}','PMW\HalamanAwalController@showPengumuman')->name('pengumuman.show');
Route::get('/upload', 'PMW\UploadController@upload')->name('upload');
Route::post('/upload/proses', 'UploadController@proses_upload')->name('upload');
Route::get('galeri','PMW\HalamanAwalController@galeri')->name('galeri');
Route::get('/galeri/{slug}','PMW\HalamanAwalController@showGaleri')->name('galeri.show');

// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', 'Admin\DashboardController@index')->name('dashboard');
    Route::resource('users', 'UserController');
    Route::post('users_mass_destroy', ['uses' => 'UserController@massDestroy', 'as' => 'users.mass_destroy']);


    Route::resource('tags', 'Profile\TagController');
    Route::post('tags_mass_destroy', ['uses' => 'Profile\TagController@massDestroy', 'as' => 'tags.mass_destroy']);

    Route::resource('blogs', 'Profile\BlogController');
    Route::post('blogs_mass_destroy', ['uses' => 'Profile\BlogController@massDestroy', 'as' => 'blogs.mass_destroy']);
    Route::post('CKeditor/upload_image', 'Profile\BlogController@uploadImageCKeditor')->name('upload');

    Route::resource('gallerys', 'Profile\GalleryController');
    Route::post('gallerys_mass_destroy', ['uses' => 'Profile\GalleryController@massDestroy', 'as' => 'gallerys.mass_destroy']);

    Route::resource('panduans', 'Profile\PanduanController');
    Route::post('panduans_mass_destroy', ['uses' => 'Profile\PanduanController@massDestroy', 'as' => 'panduans.mass_destroy']);

    Route::get('background', 'Profile\ExtraContentController@backgroundIndex')->name('background.index');
    Route::post('background', 'Profile\ExtraContentController@backgroundStore')->name('background.store');
    Route::put('background/{id}', 'Profile\ExtraContentController@updateBackground')->name('background.update');
    Route::delete('background/{id}', 'Profile\ExtraContentController@destroyBackground')->name('background.destroy');

    Route::resource('pengumumans', 'Profile\PengumumanController');
    Route::post('pengumumans_mass_destroy', ['uses' => 'Profile\PengumumanController@massDestroy', 'as' => 'pengumumans.mass_destroy']);
});
