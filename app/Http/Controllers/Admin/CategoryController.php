<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('status','Active')->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'name' => 'required',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $image_name = time().'.'.$request->image_url->extension();
        $request->image_url->move(public_path('assets\admin\upload\images\category'), $image_name);

        $category = new Category();
        $category->name = $request->name;
        $category->image_url = $image_name;
        $insert_id = $category->save();

        if($insert_id > 0){
            return redirect('admin/categories')->with('success', 'New Category Created Successfully');
        }
        else
        {
            return redirect('admin/categories')->with('fail', 'Something went wrong, please try again');
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
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


        $category = Category::find($request->id);
        $image_name = ' ';
        if (!empty($request->image_url)) {
            $image_name = time().'.'.$request->image_url->extension();
            $request->image_url->move(public_path('assets\admin\upload\images\category'), $image_name);
        }else{
            $image_name = $category->image_url;
        }

        $category->name = $request->name;
        $category->image_url = $image_name;
        $updated = $category->save();
        if ($updated > 0) {
            return redirect('admin/categories')->with('success', 'Category Updated Successfully');
        }else{
            return redirect('admin/categories')->with('fail', 'Category not updated, please try again');
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
        $category = Category::find($id);        
        $category->status = 'Active';
        $updated = $category->save();
        if ($updated > 0) {
            return redirect('admin/categories')->with('success', 'Category is Active Now');
        }else{
            return redirect('admin/categories')->with('fail', 'Something went wrong, please try again');
        }
    }

    public function status_inactive($id){
        $category = Category::find($id);        
        $category->status = 'Inactive';
        $updated = $category->save();
        if ($updated > 0) {
            return redirect('admin/categories')->with('success', 'Category is Inactive Now');
        }else{
            return redirect('admin/categories')->with('fail', 'Something went wrong, please try again');
        }
    }

}
