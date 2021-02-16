<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('webpage.index');
    }
    public function tentangkami()
    {
        return view('webpage.tentangkami');
    }
    public function blog()
    {
        return view('webpage.blog');
    }
    public function galeri()
    {
        $album = DB::table('albums')
        // ->join('album_photos', 'albums.id','=', 'album_photos.album_id')
        ->orderBy('albums.created_at', 'DESC')
        ->select('albums.*')
        ->get();
        foreach ($album as $item => $list) {
            $album[$item]->photo = DB::table('album_photos')
            ->where('album_photos.album_id', $list->id)
                ->get();
        }
        return view('webpage.galeri', ['album' => $album]);
    }
    public function karir()
    {
        return view('webpage.karir');
    }
}
