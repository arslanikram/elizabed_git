<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FabricColor;
use App\Models\Fabric;
use App\Models\Color;

class FabricColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fbrcolors = FabricColor::with('fabric','color')->where('status', 'Active')->get();
        return view('admin.fabricColor.index', compact('fbrcolors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['fabrics'] = Fabric::get();
        $data['colors'] = Color::get();
        return view('admin.fabricColor.create', compact('data'));
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
            'fabric_id' => 'required',
            'color_id' => 'required',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

         $image_name = time().'.'.$request->image_url->extension();
        $request->image_url->move(public_path('assets\admin\upload\images\fabriccolor'), $image_name);

        $fbrcolor = new FabricColor();
        $fbrcolor->fabric_id = $request->fabric_id;
        $fbrcolor->color_id = $request->color_id;
        $fbrcolor->image_url = $image_name;
        $insert_id = $fbrcolor->save();

        if($insert_id > 0){
            return redirect('admin/fabric-color')->with('success', 'New Fabric Color Created Successfully');
        }
        else
        {
            return redirect('admin/fabric-color')->with('fail', 'Something went wrong, please try again');
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
        $fbrcolor = FabricColor::find($id);
        $fabrics = Fabric::get();
        $colors = Color::get();
        return view('admin.fabricColor.edit', compact('fbrcolor','fabrics', 'colors'));
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
       // echo 1;die;
        $request->validate([
            'fabric_id' => 'required',
            'color_id' => 'required'
        ]);
    
        $fabriccolor = FabricColor::find($request->id);
        $image_name = ' ';
        if (!empty($request->image_url)) {
            $image_name = time().'.'.$request->image_url->extension();
            $request->image_url->move(public_path('assets\admin\upload\images\fabriccolor'), $image_name);
        }else{
            $image_name = $fabriccolor->image_url;
        }


         $fabriccolor->fabric_id = $request->fabric_id;
         $fabriccolor->color_id = $request->color_id;
        $fabriccolor->image_url = $image_name;
        $updated = $fabriccolor->save();
        if ($updated > 0) {
            return redirect('admin/fabric-color')->with('success', 'Fabric Color Updated Successfully');
        }else{
            return redirect('admin/fabric-color')->with('fail', 'Fabric Color not updated, please try again');
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

    public function status_Active($id){
        $fbrcolor = FabricColor::find($id);
        $fbrcolor->status = "Active";
        $update = $fbrcolor->save();

        if($update > 0){
            return redirect('admin/fabric-color')->with('success','Fabric Color status is Active');
        }else {
            return redirect('admin/fabric-color')->with('fail','Something Went Wrong');
        } 
    }

    public function status_inactive($id){
            $fbrcolor= FabricColor::find($id);
            $fbrcolor->status = 'Inactive';
            $update = $fbrcolor->save();

            if($update > 0 ){
                return redirect('admin/fabric-color')->with('success','Fabric Color Status is Inactive');
            }else{
                return redirect('admin/fabric-color')->with('fail','Something Went Wrong Please try Again');
            }
    }
}
