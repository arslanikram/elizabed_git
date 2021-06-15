<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::get();
       // return views('admin.colors.index', compact('colors'));
        return view('admin.colors.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.colors.create');
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
        ]);

        $colors = new Color();
        $colors->name = $request->name;
        $insert_id = $colors->save();

        if($insert_id > 0){
            return redirect('admin/colors')->with('success','New Color Created Successfully');
        }else {
            return redirect('admin/colors')->with('fail','Something Went Wront! Try again Later');
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
        $color = Color::find($id);
       return view('admin.colors.edit', compact('color'));
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
        ]);
        $colors = Color::find($request->id);
        $colors->name = $request->name;
        $updated = $colors->save();

        if ($updated > 0) {
            return redirect('admin/colors')->with('success', 'Color Updated Successfully');
        }else{
            return redirect('admin/colors')->with('fail', 'Color not updated, please try again');
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

    public function status_active($id){
        $color = Color::find($id);
        $color->status = 'Active';
        $updated = $color->save();
        if( $updated > 0 ){
            return redirect('admin/colors')->with('success','Color Status is Active');
        }else{
            return redirect('admin/colors')->with('fail','Something went Wrong Please try again later');
        }
    }

    public function status_inactive($id){
        $color = Color::find($id);
        $color->status = 'Inactive';
        $updated = $color->save();
        if($updated > 0){
            return redirect('admin/colors')->with('success','Fabric Status is Inactive');
        }else{
            return redirect('admin/colors')->with('fail','Something Went Wrong');
        }

    }


}
