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
    auth()->logout();
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
    session()->regenerate();
    return Redirect::to('/login/' . csrf_token());
})->name('login');
Route::get('/login/{tokens}', 'authController@index');
Route::post('/login/{csrf_token}', 'authController@loginProcess');
Route::get('/getUserLoggedIn', 'apiController@getLoggedUser');
Route::get('/forgot-password', function () {
    return view('auth.forgot');
});
Route::get('/reset-password', function () {
    return view('auth.reset');
});

// Homepage Data
Route::get('/', 'webpageController@index');
Route::get('/tentang-kami', 'webpageController@tentangkami');
Route::get('/blog', 'webpageController@blog');
Route::get('/galeri', 'webpageController@galeri');
Route::get('/karir', 'webpageController@karir');

// Dashboard data url
Route::get('/tool', function () {
    return Redirect::to('/tools');
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/{any}', function () {
        return view('layout');
    })->where('any', '.*');
});
