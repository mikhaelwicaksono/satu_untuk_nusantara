<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function providerUmkm()
    {
        return view('pages.provider-umkm');
    }

    public function managingStore()
    {
        return view('pages.managing-store');
    }
}
