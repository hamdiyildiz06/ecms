<?php

namespace App\Http\Controllers\Frontend;

use App\Blogs;
use App\Http\Controllers\Controller;
use App\Sliders;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class DefaultController extends Controller
{
    public function index(){

        $data['slider'] = Sliders::all()->sortBy('slider_must');
        $data['blog'] = Blogs::all()->sortBy('blog_must');

        return view('frontend.default.index',compact('data'));
    }

    public function contact(){
        return view('frontend.default.contact');
    }
}
