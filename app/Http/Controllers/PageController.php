<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    public function mentions(): View
    {
        return view('pages.mentions');
    }

    public function cgu(): View
    {
        return view('pages.cgu');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }
}