<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Pages;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function detail($slug){
        $page = Pages::where('page_slug',$slug)->first();
        $pagelist = Pages::all()->sortBy('page_must');


        return view('frontend.page.detail',compact('page','pagelist'));
    }
}
