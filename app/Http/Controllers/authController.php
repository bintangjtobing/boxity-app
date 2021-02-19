<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function loginProcess(Request $request)
    {
        $request->merge(['status' => '1']);
        if (Auth::attempt($request->only('email', 'password', 'status'))) {
            $user = User::where(['email' => $request->email])->first();
            Auth::loginUsingId($user->id, TRUE);
            return redirect('/tool');
        }
        return back()->with('gagal', ' Please check your auth status or your input!');
    }
}
