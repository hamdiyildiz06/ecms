<?php

namespace App\Http\Controllers\Frontend;

use App\Blogs;
use App\Http\Controllers\Controller;
use App\Sliders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;


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

    public function sendMail(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);

        $data  = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message
        ];
        Mail::to('hamdi.yildiz@hatipogluhukuk.net')->send(new SendMail($data));
        return back()->with('Success','Mail Başarıyla gönderildi');

    }
}
