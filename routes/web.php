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
Route::get('/newissue', function () {
    return view('emails.sites.newIssue');
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
Route::get('/login', 'authController@index');

// Homepage Data
Route::get('/', 'webpageController@index');
Route::get('/tentang-kami', 'webpageController@tentangkami');
Route::get('/blog', 'webpageController@blog');
Route::get('/galeri', 'webpageController@galeri');
Route::get('/karir', 'webpageController@karir');

// Dashboard data url
Route::get('/tools', 'DashboardController@index');
