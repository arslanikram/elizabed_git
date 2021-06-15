<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Fabric;
use App\Models\FabricColor;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductSpecification;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductImage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category','sub_category')->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $sub_categories = SubCategory::get();
        $fabrics = Fabric::where('status', 'Active')->get();
        return view('admin.products.create', compact('categories', 'sub_categories', 'fabrics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'product_name' => 'required',
            'description' => 'required',
            'delivery_time' => 'required',
            'size' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'original_price' => 'required',
            'height' => 'required',
            'width' => 'required',
            'length' => 'required',
            'stock' => 'required',
            'image_url' => 'required'
        ]);

        $products = new Product();
        $products->category_id = $request->category_id;
        $products->subcategory_id = $request->subcategory_id;
        $products->product_name = $request->product_name;
        $products->description = $request->description;
        $products->delivery_time = $request->delivery_time;
        $products->save();

        $product_insert_id = $products->id;


        if (!empty($product_insert_id)) {

            $product_spec = new ProductSpecification();
            $product_spec->product_id = $product_insert_id;
            $product_spec->size = $request->size;
            $product_spec->price = $request->price;
            $product_spec->discount = $request->discount;
            $product_spec->original_price = $request->original_price;
            $product_spec->height = $request->height;
            $product_spec->width = $request->width;
            $product_spec->length = $request->length;
            $product_spec->stock = $request->stock;
            $product_spec->save();

            if ($request->color_option == 'Yes' && !empty($request->colors)){
                for ($x=0; $x < count($request->colors); $x++){
                    $product_color = new ProductColor();
                    $product_color->product_id = $product_insert_id;
                    $product_color->color_id = $request->colors[$x];
                    $product_color->save();
                }
            }
            elseif ($request->color_option == 'Others' && !empty($request->other_color))
            {
                $new_colors = explode(",",$request->other_color);
                for ($x=0; $x < count($new_colors); $x++){
                    $new_color = new Color();
                    $new_color->name = trim($new_colors[$x]);
                    $new_color->save();

                    $new_color_id = $new_color->id;

                    if (!empty($new_color_id)){
                        $product_color = new ProductColor();
                        $product_color->product_id = $product_insert_id;
                        $product_color->color_id = $new_color_id;
                        $product_color->save();
                    }
                }
            }

            /** image */

            $input = $request->all();
            $images = array();
            if ($files = $request->file('image_url')) {
                foreach ($files as $file) {
                    $name = time() . $file->getClientOriginalName();
                    $file->move(public_path('assets\admin\upload\images\products'), $name);
                    $images[] = $name;
                }
            }

            if (count($images) > 0) {
                for ($x = 0; $x < count($images); $x++) {
                    $product_image = new ProductImage();
                    $product_image->product_id = $product_insert_id;
                    $product_image->image_url = $images[$x];
                    $product_image->save();
                }
            }


        }


        if ($product_insert_id > 0) {
            return redirect('admin/product')->with('success', 'New Product Created Successfully');
        } else {
            return redirect('admin/product')->with('fail', 'Something went wrong, please try again');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $product_images = ProductImage::where('product_id',$id)->get();
        $categories = Category::get();
        $product_spec = ProductSpecification::find($id);
        $sub_categories = SubCategory::get();
        return view('admin.products.show', compact('product', 'product_images', 'categories', 'sub_categories', 'product_spec'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::get();
        $product_spec = ProductSpecification::find($id);
        $sub_categories = SubCategory::get();
        return view('admin.products.edit', compact('product', 'categories', 'sub_categories', 'product_spec'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'product_name' => 'required',
            'description' => 'required',
            'delivery_time' => 'required',
            'color' => 'required',
            'other_colors' => 'required',
            /* product specification */
            'size' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'original_price' => 'required',
            'height' => 'required',
            'width' => 'required',
            'length' => 'required',
            'stock' => 'required',
            /** image */
            'image_url' => 'required'
        ]);

        $products = Product::find($request->id);
        $products->category_id = $request->category_id;
        $products->subcategory_id = $request->subcategory_id;
        $products->product_name = $request->product_name;
        $products->description = $request->description;
        $products->delivery_time = $request->delivery_time;
        $products->color = $request->color;
        $products->other_colors = $request->other_colors;
        $updated = $products->save();
        /* specification update */
        $product_spec = ProductSpecification::find($request->id);
        $product_spec->size = $request->size;
        $product_spec->price = $request->price;
        $product_spec->discount = $request->discount;
        $product_spec->original_price = $request->original_price;
        $product_spec->length = $request->length;
        $product_spec->stock = $request->stock;
        $updated = $product_spec->save();
        if ($updated > 0) {
            return redirect('admin/product')->with('success', 'Product Updated Successfully');
        } else {
            return redirect('admin/product')->with('fail', 'Product not updated, please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function get_subCategory(Request $request)
    {
        $category_id = $request->category_id;
        $sub_categories = SubCategory::where('category_id', $category_id)->get()->toArray();
        return json_encode($sub_categories);
    }

    public function get_fabric_color(Request $request)
    {
        $fabric_id = $request->fabric_id;
        $fabric_colors = FabricColor::with('color')->where('fabric_id', $fabric_id)->get()->toArray();
        $data = array();
        if (!empty($fabric_colors)) {
            foreach ($fabric_colors as $key => $color) {
                $data[] = $color['color'];
            }
        }
        return json_encode($data);
    }

}
