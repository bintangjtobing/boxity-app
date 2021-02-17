<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    return redirect('/');
});
Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');
    return redirect('/');
});
Route::get('/optimize-clear', function () {
    $exitCode = Artisan::call('optimize:clear');
    return redirect('/');
});
Route::get('/clear-view', function () {
    $exitCode = Artisan::call('view:clear');
    return redirect('/');
});
Route::get('/sign-out', function () {
    session()->flush();
    return redirect('/tool');
});

// Social Media Redirect
Route::get('/facebook', function () {
    return Redirect::to('https://facebook.com/BTSALogistics');
});
Route::get('/instagram', function () {
    return Redirect::to('https://www.instagram.com/btsalogistics');
});
Route::get('/youtube', function () {
    return Redirect::to('https://www.youtube.com/c/BTSALogisticsYourReliableLogisticsPartner');
});
Route::get('/wikipedia', function () {
    return Redirect::to('https://id.wikipedia.org/wiki/Pengguna:Btsalogistics');
});

// Auth url
Route::get('/login', function () {
    $tokens = bin2hex(openssl_random_pseudo_bytes(64));
    return Redirect::to('/login/' . $tokens);
});
Route::get('/login/{tokens}', 'authController@index');
Route::post('/login/{tokens}', 'authController@loginProcess');

// Homepage Data
Route::get('/', 'webpageController@index');
Route::get('/tentang-kami', 'webpageController@tentangkami');
Route::get('/blog', 'webpageController@blog');
Route::get('/galeri', 'webpageController@galeri');
Route::get('/karir', 'webpageController@karir');

// Dashboard data url
Route::group(['middleware' => ['islogin']], function () {
    Route::get('/tool', function () {
        return Redirect::to('/tools/{any}');
    });
    Route::get('/tools/{any}', function () {
        return view('dashboard.layout');
    })->where('any', '.*');
});
