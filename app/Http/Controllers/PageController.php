<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function caraPesan()
    {
        return view('pages.cara-pesan');
    }

    public function tentangKami()
    {
        return view('pages.tentang-kami');
    }
}