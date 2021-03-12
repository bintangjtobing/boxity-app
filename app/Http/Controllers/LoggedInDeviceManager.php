<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoggedInDeviceManager extends Controller
{
    public function index()
    {
        $devices = DB::table('sessions')
            ->where('user_id', \Auth::user()->id)
            ->get()->reverse();

        // return view('logged-in-devices.list')
        //     ->with('devices', $devices)
        //     ->with('current_session_id', \Session::getId());
        return response()->json(['devices' => $devices, 'current_session_id' => \Session::getId()]);
    }
    public function logoutDevice(Request $request, $device_id)
    {

        \DB::table('sessions')
            ->where('id', $device_id)->delete();

        return redirect('/logged-in-devices');
    }
    public function logoutAllDevices(Request $request)
    {
        \DB::table('sessions')
            ->where('user_id', \Auth::user()->id)
            ->where('id', '!=', \Session::getId())->delete();

        return redirect('/logged-in-devices');
    }
}
