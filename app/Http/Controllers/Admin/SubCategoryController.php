<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\SubCategory;
use App\models\Category;
class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = SubCategory::with('category')->where('status','Active')->get();
        return view('admin.subcategory.index', compact('subcategories'));
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories= Category::get();
        return view('admin.subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

         $image_name = time().'.'.$request->image_url->extension();
        $request->image_url->move(public_path('assets\admin\upload\images\subcategory'), $image_name);

        $subcategory = new SubCategory();
        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->image_url = $image_name;
        $insert_id = $subcategory->save();

        if($insert_id > 0){
            return redirect('admin/sub-categories')->with('success', 'New SubCategory Created Successfully');
        }
        else
        {
            return redirect('admin/sub-categories')->with('fail', 'Something went wrong, please try again');
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
        //echo $id;
        $categories = Category::get();
         $subcategory = SubCategory::find($id);
        return view('admin.subcategory.edit', compact('subcategory','categories'));
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
        //
         $request->validate([
            'name' => 'required',
            'category_id' => 'required'
        ]);
    
        $subcategories = SubCategory::find($request->id);
        $image_name = ' ';
        if (!empty($request->image_url)) {
            $image_name = time().'.'.$request->image_url->extension();
            $request->image_url->move(public_path('assets\admin\upload\images\subcategory'), $image_name);
        }else{
            $image_name = $subcategories->image_url;
        }


         $subcategories->name = $request->name;
         $subcategories->category_id = $request->category_id;
        $subcategories->image_url = $image_name;
        $updated = $subcategories->save();
        if ($updated > 0) {
            return redirect('admin/sub-categories')->with('success', 'Category Updated Successfully');
        }else{
            return redirect('admin/sub-categories')->with('fail', 'Category not updated, please try again');
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

            $subcategory = SubCategory::find($id);        
            $subcategory->status = 'Active';
            $updated = $subcategory->save();
            if ($updated > 0) {
                return redirect('admin/sub-categories')->with('success', 'Sub-Category is Active Now');
            }else{
                return redirect('admin/sub-categories')->with('fail', 'Something went wrong, please try again');
            }
    }

    public function status_inactive($id){
        
        $subcategory = SubCategory::find($id);        
        $subcategory->status = 'Inactive';
        $updated = $subcategory->save();
        if ($updated > 0) {
            return redirect('admin/sub-categories')->with('success', 'Sub-Category is Inactive Now');
        }else{
            return redirect('admin/sub-categories')->with('fail', 'Something went wrong, please try again');
        }
    }
}
