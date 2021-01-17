<?php

namespace App\Http\Controllers\Backend;

use App\Pages;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['page'] = Pages::all()->sortBy('page_must');
        return view('backend.pages.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.create');
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
            'slider_title'=>'required',
            'slider_content'=>'required',
        ]);

        if (strlen($request->page_slug) > 3){
            $slug = Str::slug($request->page_slug, '-');
        }else{
            $slug = Str::slug($request->page_title, '-');
        }

        if ($request->hasFile('page_file')){
            $request->validate([
                'page_file' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            $images = pathinfo($request->file('page_file')->getClientOriginalName());
            $image_name = $images['filename'];
            $image_extension = $request->file('page_file')->getClientOriginalExtension();
            $file_name = $image_name.'-'.rand(11111,99999).'.'.$image_extension;
            $request->page_file->move(public_path('/images/pages'),$file_name);

        }else{
            $file_name = null;
        }




        $page = Pages::insert(
          [
              "page_title" => $request->page_title,
              "page_slug" => $slug,
              "page_file" => $file_name,
              "page_must" => 1,
              "page_content" => $request->page_content,
              "page_status" => $request->page_status,
          ]
        );

        if ($page){
            return redirect(route('page.index'))->with('success','İşlem Başarılı');
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
        $pages = Pages::where('id',$id)->first();
        return view('backend.pages.edit')->with('pages',$pages);
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
            'slider_title'=>'required',
            'slider_content'=>'required'
        ]);

        if (strlen($request->page_slug) > 3){
            $slug = Str::slug($request->page_slug, '-');
        }else{
            $slug = Str::slug($request->page_title, '-');
        }

        if ($request->hasFile('page_file')){
            $request->validate([
                'page_file' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            $images = pathinfo($request->file('page_file')->getClientOriginalName());
            $image_name = $images['filename'];
            $image_extension = $request->file('page_file')->getClientOriginalExtension();
            $file_name = $image_name.'-'.rand(11111,99999).'.'.$image_extension;
            $request->page_file->move(public_path('/images/pages'),$file_name);

            $page = Pages::where('id',$id)->update(
                [
                    "page_title" => $request->page_title,
                    "page_slug" => $slug,
                    "page_file" => $file_name,
                    "page_must" => 1,
                    "page_content" => $request->page_content,
                    "page_status" => $request->page_status,
                    "page_must" => $request->page_must,
                ]
            );

            $path = "images/pages/".$request->old_file;
            if (file_exists($path)){
                @unlink(public_path($path));
            }

        }else{

            $page = Pages::where('id',$id)->update(
                [
                    "page_title" => $request->page_title,
                    "page_slug" => $slug,
                    "page_must" => 1,
                    "page_content" => $request->page_content,
                    "page_status" => $request->page_status,
                    "blog_must" => $request->blog_must,
                ]
            );
        }

        if ($page){
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
        $page = Pages::find(intval($id));
        if ($page->delete()){
            echo 1;
        }
       echo 0;
    }

    public function sortable()
    {
//        print_r($_POST['item']);

        foreach ($_POST['item'] as $key => $value)
        {
            $page=Pages::find(intval($value));
            $page->page_must=intval($key);
            $page->save();
        }

        echo true;
    }
}
