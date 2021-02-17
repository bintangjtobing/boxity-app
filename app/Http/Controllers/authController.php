<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function loginProcess(Request $request)
    {
        $tokens = str_random(50);
        $email = $request->email;
        $password = $request->pass;
        $check = DB::table('users')
            ->where('email', $email)
            ->first();

        if ($check && HASH::check($password, $check->password)) {
            $check->isLogin = 'login';
            $check = (array)$check;
            session($check);

            return redirect('/tool');
        }

        return back()->with('gagal', 'Please check your auth status or your input!');
    }
}
