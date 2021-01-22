<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Sliders;
use Illuminate\Http\Request;


class DefaultController extends Controller
{
    public function index(){
        $data['slider'] = Sliders::all()->sortBy('slider_must');
        return view('frontend.default.index',compact('data'));
    }
}
