<?php

namespace App\Http\Controllers\Backend;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['user'] = User::all()->sortBy('user_must');
        return view('backend.users.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:6'
        ]);



        if ($request->hasFile('user_file')){
            $request->validate([
                'user_file' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            $images = pathinfo($request->file('user_file')->getClientOriginalName());
            $image_name = $images['filename'];
            $image_extension = $request->file('user_file')->getClientOriginalExtension();
            $file_name = $image_name.'-'.rand(11111,99999).'.'.$image_extension;
            $request->user_file->move(public_path('/images/users'),$file_name);

        }else{
            $file_name = null;
        }




        $user = User::insert(
            [
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password),
                "user_file" => $file_name,
                "user_must" => 1,
                "user_status" => $request->user_status
            ]
        );

        if ($user){
            return redirect(route('user.index'))->with('success','İşlem Başarılı');
        }
        return back()->with('error','İşlem Başarısız !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::where('id',$id)->first();
        return view('backend.users.edit')->with('users',$users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
        ]);

        if ($request->hasFile('user_file')){
            $request->validate([
                'user_file' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            $images = pathinfo($request->file('user_file')->getClientOriginalName());
            $image_name = $images['filename'];
            $image_extension = $request->file('user_file')->getClientOriginalExtension();
            $file_name = $image_name.'-'.rand(11111,99999).'.'.$image_extension;
            $request->user_file->move(public_path('/images/users'),$file_name);

            if (strlen($request->password) > 0){

                $request->validate([
                    'password'=>'required|min:6'
                ]);

                $user = User::where('id',$id)->update(
                    [
                        "name" => $request->name,
                        "email" => $request->email,
                        "password" => Hash::make($request->password),
                        "user_file" => $file_name,
                        "user_must" => $request->user_must,
                        "user_status" => $request->user_status
                    ]
                );
            }else{
                $user = User::where('id',$id)->update(
                    [
                        "name" => $request->name,
                        "email" => $request->email,
                        "user_file" => $file_name,
                        "user_must" => $request->user_must,
                        "user_status" => $request->user_status
                    ]
                );
            }



            $path = "images/users/".$request->old_file;
            if (file_exists($path)){
                @unlink(public_path($path));
            }

        }else{

            if (strlen($request->password) > 0){

                $request->validate([
                    'password'=>'required|min:6'
                ]);

                $user = User::where('id',$id)->update(
                    [
                        "name" => $request->name,
                        "email" => $request->email,
                        "password" => Hash::make($request->password),
                        "user_must" => $request->user_must,
                        "user_status" => $request->user_status
                    ]
                );
            }else{
                $user = User::where('id',$id)->update(
                    [
                        "name" => $request->name,
                        "email" => $request->email,
                        "user_must" => $request->user_must,
                        "user_status" => $request->user_status
                    ]
                );
            }
        }

        if ($user){
            return back()->with('success','İşlem Başarılı');
        }
        return back()->with('error','İşlem Başarısız !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find(intval($id));
        if ($user->delete()){
            echo 1;
        }
        echo 0;
    }

    public function sortable()
    {
//        print_r($_POST['item']);

        foreach ($_POST['item'] as $key => $value)
        {
            $user=User::find(intval($value));
            $user->user_must=intval($key);
            $user->save();
        }

        echo true;
    }
}
