<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class spaController extends Controller
{
    public function index()
    {
        return view('layout');
    }
}
