<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Fabric;


class FabricController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     **/
    public function index()
    {
        $fabrics = Fabric::get();
        return view('admin.fabric.index', compact('fabrics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.fabric.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'name' => 'required'
        ]);

        $fabric= new Fabric();
        $fabric->name = $request->name;
        $insert_id = $fabric->save();
        if($insert_id > 0){
            return redirect('admin/fabric')->with('success', 'New Fabric Created Successfully');
        }
        else
        {
            return redirect('admin/fabric')->with('fail', 'Something went wrong, please try again');
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
         $fabric = Fabric::find($id);
        return view('admin.fabric.edit', compact('fabric'));
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
            'name' => 'required'
        ]);

        $fabric = Fabric::find($request->id);

         $fabric->name = $request->name;
        $updated = $fabric->save();
        if ($updated > 0) {
            return redirect('admin/fabric')->with('success', 'Fabric Updated Successfully');
        }else{
            return redirect('admin/fabric')->with('fail', 'Fabric not updated, please try again');
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
        $fabric = Fabric::find($id);
        $fabric->status = 'Active';
        $updated = $fabric->save();
        if( $updated > 0 ){
            return redirect('admin/fabric')->with('success','Fabric Status is Active');
        }else{
            return redirect('admin/fabric')->with('fail','Something went Wrong Please try again later');
        }
    }

    public function status_inactive($id){
        $fabric = Fabric::find($id);
        $fabric->status = 'Inactive';
        $updated = $fabric->save();
        if($updated > 0){
            return redirect('admin/fabric')->with('success','Fabric Status is Inactive');
        }else{
            return redirect('admin/fabric')->with('fail','Something Went Wrong');
        }

    }
}
