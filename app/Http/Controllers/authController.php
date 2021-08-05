<?php

namespace App\Http\Controllers;

use App\changeLog;
use App\company_details;
use App\Mail\askReset;
use App\Mail\doneReset;
use App\User;
use App\userLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class authController extends Controller
{
    public function index()
    {
        $version = changeLog::orderBy('created_at', 'DESC')->first();
        $company = company_details::first();
        return view('auth.login', ['version' => $version, 'company' => $company]);
    }
    public function forgotPassword()
    {
        $version = changeLog::orderBy('created_at', 'DESC')->first();
        $company = company_details::first();
        return view('auth.forgot', ['version' => $version, 'company' => $company]);
    }
    public function askReset(Request $request)
    {
        $version = changeLog::orderBy('created_at', 'DESC')->first();
        $company = company_details::first();

        $email = $request->email;
        $users = User::where('email', '=', $email)->get();
        $user = $users[0];

        $saveLogs = new userLogs();
        $saveLogs->userId = $user->id;
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Asking for reset password';
        $saveLogs->save();

        Mail::to($email)->send(new askReset($user));
        return view('auth.doneForgot', ['company' => $company, 'version' => $version]);
    }
    public function resetPassword($id)
    {
        $version = changeLog::orderBy('created_at', 'DESC')->first();
        $company = company_details::first();

        $user = User::where('id', $id)->get();
        return view('auth.reset', ['user' => $user[0]]);
    }
    public function processResetPassword($id, Request $request)
    {
        $version = changeLog::orderBy('created_at', 'DESC')->first();
        $company = company_details::first();

        $users = User::where('id', $id)->get();
        $user = $users[0];
        $user->password = Hash::make($request->password);
        $user->save();

        $saveLogs = new userLogs();
        $saveLogs->userId = $user->id;
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Successfully reset password.';
        $saveLogs->save();

        Mail::to($user->email)->send(new doneReset($user));
        return view('auth.doneReset', ['company' => $company, 'version' => $version]);
    }
    public function loginProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'g-recaptcha-response' => 'required|captcha'
        ]);
        if ($validator->fails()) {
            return back()->with('gagal', 'The re-captcha response is required!');
        } else {
            $remember_me = $request->has('remember') ? true : false;
            $request->merge(['status' => '1']);
            if (Auth::attempt($request->only('email', 'password', 'status'), $remember_me)) {
                $user = User::where(['email' => $request->email])->first();
                Auth::loginUsingId($user->id, TRUE);

                $saveLogs = new userLogs();
                $saveLogs->userId = Auth::id();
                $saveLogs->ipAddress = $request->ip();
                $saveLogs->notes = 'Logged in to system.';
                $saveLogs->save();

                return redirect('/tools');
            }
            return back()->with('gagal', ' Please check your auth status or your input!');
        }
        // return 200;
    }
}
