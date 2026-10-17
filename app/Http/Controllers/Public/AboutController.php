<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index()
    {
        return view('public.pages.about');
    }
}
