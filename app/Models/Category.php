<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;

    public function subCategory()
    {
    	return $this->hasMany(SubCategory::class, 'category_id');
    }

    public function product(){
        return $this->hasMany(Product::class, 'category_id');
    }
}
