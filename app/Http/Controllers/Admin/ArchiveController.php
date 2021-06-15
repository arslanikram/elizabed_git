<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Fabric;
use App\Models\FabricColor;

class ArchiveController extends Controller
{
    public function category(){
        $categories = Category::where('status','Inactive')->get();
        return view('admin.archive.category', compact('categories'));
    }

    public function subCategory(){
        $subCategories = SubCategory::where('status','Inactive')->get();
        return view('admin.archive.subCategory', compact('subCategories'));
    }

    public function fabric(){
        $fabrics = Fabric::where('status','Inactive')->get();
        return view('admin.archive.fabric', compact('fabrics'));
    }

    
    public function fabricColor(){
        $fbrcolors = FabricColor::where('status','Inactive')->get();
        return view('admin.archive.fabricColor', compact('fbrcolors'));
    }
}
