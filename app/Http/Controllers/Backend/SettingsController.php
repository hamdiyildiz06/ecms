<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(){
//        $data = Settings::all()->paginate(10);
        $data['adminSettings'] = Settings::all()->sortBy('settings_must');
        return view('backend.settings.index',compact('data'));
    }

    public function sortable()
    {
//        print_r($_POST['item']);

         foreach ($_POST['item'] as $key => $value)
         {
             $settings=Settings::find(intval($value));
             $settings->settings_must=intval($key);
             $settings->save();
         }

         echo true;
    }

    public function destroy($id){
        $settings = Settings::find($id);
        if ($settings->delete()){
            return back()->with('success','işlem Başarılı');
        }
        return back()->with('error','işlem Başarısız !!!');
    }

    public function edit($id){
        $settings = Settings::where('id',$id)->first();
        return view('backend.settings.edit')->with('settings',$settings);
    }

    public function update(Request $request,$id){
        $settings = Settings::where('id',$id)->update(
            [
                "settings_value" => $request->settings_value
            ]
        );

        if ($settings){
            return back()->with('success','Düzenleme işlemi Başarılı');
        }
        return back()->with('error','Düzenleme işlemi Başarısız !!!');
    }



}

