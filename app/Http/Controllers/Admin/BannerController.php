<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::get();
       // return views('admin.banners.index', compact('banners'));
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banners.create');
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
            'name' => 'required|max:255',
            'image_url' => 'required',
            'product_url' => 'required'
        ]);
        $image_name = time().'.'.$request->image_url->extension();
        $request->image_url->move(public_path('assets\admin\upload\images\banners'), $image_name);

        $banners = new Banner();
        $banners->name = $request->name;
        $banners->image_url = $image_name;
        $banners->product_url = $request->product_url;
        $insert_id = $banners->save();

        if($insert_id > 0){
            return redirect('admin/banner')->with('success','New Banner Created Successfully'); 
        }else {
            return redirect('admin/banner')->with('fail','Something Went Wront! Try again Later');
        }
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
        $banner = Banner::find($id);
       return view('admin.banners.edit', compact('banner'));
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
        //print_r($request->id);die;
        $request->validate([
            'name'=>'required',
            'product_url'=>'required',
        ]);
        $banners = Banner::find($request->id);
        $banners->name = $request->name;
        $banners->product_url = $request->product_url;
        $updated = $banners->save();

        if ($updated > 0) {
            return redirect('admin/banner')->with('success', 'Banner Updated Successfully');
        }else{
            return redirect('admin/banner')->with('fail', 'Banner not updated, please try again');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
