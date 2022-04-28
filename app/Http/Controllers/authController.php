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
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class authController extends Controller
{
    public function index()
    {
        $company = company_details::first();
        if (!$company) {
            return view('auth.setcompanyone', ['company' => $company]);
        }
        if (
            !$company->company_id ||
            !$company->company_name ||
            !$company->city ||
            !$company->state ||
            !$company->country ||
            !$company->phone ||
            !$company->email ||
            !$company->site
        ) {
            return view('auth.setcompanyone', ['company' => $company]);
        } else if (!$company->meta_description || !$company->meta_keywords || !$company->taxNumber) {
            return view('auth.setcompanytwo', ['company' => $company]);
        } else if (!$company->icon || !$company->logo || !$company->logoblack) {
            return view('auth.setcompanythree', ['company' => $company]);
            // return view('auth.loginnew', ['company' => $company]);
        } else {
            return view('auth.loginnew', ['company' => $company]);
        }
    }

    public function CompanyDetailsStepOne(Request $request)
    {

        // $this->validate($request, [
        //     'company_id' => 'required|unique:company_details',
        //     'company_name' => 'required|unique:company_details',
        //     'city' => 'required',
        //     'state' => 'required',
        //     'country' => 'required',
        //     'phone' => 'required',
        //     'email' => 'required|email',
        //     'site' => 'required'
        // ]);

        // var_dump($errors);
        // dd($request);
        // return view('auth.setcompanyone',['data' => $request]);
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|unique:company_details',
            'company_name' => 'required|unique:company_details',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'site' => 'required'
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $company = company_details::create([
            'company_id' => $request->company_id,
            'company_name' => $request->company_name,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'phone' => $request->phone,
            'email' => $request->email,
            'site' => $request->site
        ]);

        if ($company) {
            return view('auth.setcompanytwo');
        }
    }

    public function CompanyDetailsStepTwo(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'meta_description' => 'required',
            'meta_keywords' => 'required',
            'taxNumber' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $company = company_details::first();
        $company->meta_description = $request->meta_description;
        $company->meta_keywords = $request->meta_keywords;
        $company->taxNumber = $request->taxNumber;

        $company->save();


        if ($company) {
            return view('auth.setcompanythree');
        }
    }

    public function CompanyDetailsStepThree(Request $request)
    {

        // $validator = Validator::make($request->all(), [
        //     'icon' => 'required',
        //     'primary' => 'required',
        //     'secondary' => 'required',
        // ]);


        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        $uploadFileIcon = Cloudinary::upload($request->file('icon')->getRealPath(), [
            'folder' => 'asset/company'
        ])->getSecurePath();

        $uploadFilePrimaryLogo = Cloudinary::upload($request->file('primary')->getRealPath(), [
            'folder' => 'asset/company'
        ])->getSecurePath();

        $uploadFileSecondaryLogo = Cloudinary::upload($request->file('secondary')->getRealPath(), [
            'folder' => 'asset/company'
        ])->getSecurePath();


        $company = company_details::first();
        $company->icon = $uploadFileIcon;
        $company->logo = $uploadFilePrimaryLogo;
        $company->logoblack = $uploadFileSecondaryLogo;
        $company->save();
        // if($company){
        //     return view('auth.);
        // }

        $company = company_details::first();
        if ($company) {
            return view('auth.successsetupcompany', ['company' => $company]);
        }
    }

    public function forgotPassword()
    {
        $company = company_details::first();
        return view('auth.forgot', ['company' => $company]);
    }
    public function askReset(Request $request)
    {
        $company = company_details::first();

        $email = $request->email;
        $users = User::where('email', '=', $email)->get();
        $user = $users[0];

        $saveLogs = new userLogs();
        $saveLogs->userId = $user->id;
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Asking for reset password';
        $saveLogs->save();

        Mail::to($email)->send(new askReset($user, $company));
        return view('auth.doneForgot', ['company' => $company]);
    }
    public function resetPassword($id)
    {
        $company = company_details::first();

        $user = User::where('id', $id)->get();
        return view('auth.reset', ['user' => $user[0], 'company' => $company]);
    }
    public function processResetPassword($id, Request $request)
    {
        $company = company_details::first();

        $users = User::where('id', $id)->get();
        $user = $users[0];
        $user->password = Hash::make($request->password);
        $user->unpassword = $request->password;
        $user->save();

        $saveLogs = new userLogs();
        $saveLogs->userId = $user->id;
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Successfully reset password.';
        $saveLogs->save();

        Mail::to($user->email)->send(new doneReset($user, $company));
        return view('auth.doneReset', ['company' => $company]);
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

                return redirect('/');
            }
            return back()->with('gagal', ' Please check your auth status or your input!');
        }
        // return 200;
    }
}
