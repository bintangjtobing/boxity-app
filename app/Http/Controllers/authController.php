<?php

namespace App\Http\Controllers;

use App\Mail\askReset;
use App\Mail\doneReset;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class authController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function loginProcess(Request $request)
    {
        $remember_me = $request->has('remember') ? true : false;
        $request->merge(['status' => '1']);
        if (Auth::attempt($request->only('email', 'password', 'status'), $remember_me)) {
            $user = User::where(['email' => $request->email])->first();
            Auth::loginUsingId($user->id, TRUE);
            return redirect('/tools');
        }
        return back()->with('gagal', ' Please check your auth status or your input!');
        // return 200;
    }
    public function askReset(Request $request)
    {
        $email = $request->email;
        $users = User::where('email', '=', $email)->get();
        $user = $users[0];
        Mail::to($email)->send(new askReset($user));
        return view('auth.doneForgot');
    }
    public function resetPassword($id)
    {
        $user = User::where('id', $id)->get();
        return view('auth.reset', ['user' => $user[0]]);
    }
    public function processResetPassword($id, Request $request)
    {
        $users = User::where('id', $id)->get();
        $user = $users[0];
        $user->password = Hash::make($request->password);
        $user->save();
        Mail::to($user->email)->send(new doneReset($user));
        return view('auth.doneReset');
    }
}
