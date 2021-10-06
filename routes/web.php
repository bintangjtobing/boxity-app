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

use App\Http\Controllers\spaController;
use App\userLogs;
use Illuminate\Http\Request;
use App\candidates;

Route::get('/sign-out', function (Request $request) {
    header("cache-Control: no-store, no-cache, must-revalidate");
    header("cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

    // Save logs logout
    $saveLogs = new userLogs();
    $saveLogs->userId = Auth::id();
    $saveLogs->ipAddress = $request->ip();
    $saveLogs->notes = 'Logged out from system.';
    $saveLogs->save();

    Artisan::call('cache:clear');
    Session::flush();
    auth()->logout();
    Session::regenerate();
    return redirect('/');
});

// Auth url
Route::get('/login', function () {
    session()->regenerate();
    return Redirect::to('/login/' . csrf_token());
})->name('login');
Route::get('/login/{tokens}', 'authController@index');
Route::post('/login/{csrf_token}', 'authController@loginProcess');
Route::get('/getUserLoggedIn', 'apiController@getLoggedUser');
Route::get('/forgot-password', 'authController@forgotPassword');
Route::get('/ask-reset-password', 'authController@askReset');
Route::get('/reset-password/{id}', 'authController@resetPassword');
Route::post('/reset-password/{id}', 'authController@processResetPassword');

// REPORTING PDF
Route::get('/report/purchase/order/{po_number}', 'purchasingController@reportPO');
Route::get('/report/purchase/invoices/{pi_number}', 'purchasingController@reportPI');
Route::get('/report/purchase/return/{pr_number}', 'purchasingController@reportPR');
Route::get('/report/purchase/request/{pre_number}', 'purchasingController@reportPRE');
Route::get('/report/test', 'purchasingController@reportTest');

// SALES REPORT
Route::get('/report/sales/invoices/{si_number}', 'salesController@reportSI');
Route::get('/report/sales/order/{so_number}', 'salesController@reportSalesOrder');
Route::get('/report/delivery-receipt/{sdr_number}', 'salesController@reportSSdr');

// Reporting PDF
Route::get('/generate/pdf/{id}', function ($id) {
    $candidate = candidates::where('id', $id)->with('posisi')->with('provinsi')->with('domisili')->with('kecamatan')->with('kelurahan')->with('agama')->with('suku')->orderBy('created_at', 'DESC')->first();
    return view('dashboard.pdf.candidate', ['candidate' => $candidate]);
});
// Dashboard data url
// Route::get('/tool', function () {
//     return Redirect::to('/tools');
// });
Route::group(['middleware' => 'auth'], function () {
    Route::get('/{any}', 'spaController@index')->where('any', '.*');
});
