@extends('admin.layouts.app')
@section('content')
<div class="main-panel">        
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
                Edit Product
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Product</h4>
                  
                  <form class="forms-sample" action="{{route('product.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                    {{method_field('PATCH')}}
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Category</label>
                                <select class="form-control" name="category_id">
                                    <option class="form-control" value="">Select Category</option>
                                    @foreach($categories as $category)
                                    <option class="form-control" value="{{$category->id}}" {{ $product->category_id == $category->id ? 'selected' : '' }}  >{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">SubCategory</label>
                                <select class="form-control" name="subcategory_id">
                                    <option class="form-control" value="">Select subCategory</option>
                                    @foreach($sub_categories as $sub_categorie)
                                    <option class="form-control" value="{{$sub_categorie->id}}" {{ $product->subcategory_id == $sub_categorie->id ? 'selected' : '' }}>{{$sub_categorie->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" class="form-control" id="product_name" value="{{$product->product_name}}" name="product_name" placeholder="Enter Product Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Description</label>
                                <textarea name="description" id="summary-ckeditor" class="form-control" rows='2'>{{$product->product_name}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Delivery Time</label>
                                <!-- <input type="text" class="form-control" id="color_name" name="color_name" placeholder="Color Name"> -->
                                <select class="form-control" name="delivery_time">
                                    <option class="form-control" value="">Select Delivery Time</option>
                                    <option class="form-control" value="withIn One Week" {{ $product->delivery_time == 'withIn One Week' ? 'selected' : '' }}>withIn One Week</option>
                                    <option class="form-control" value="withIn Two Week" {{ $product->delivery_time == 'withIn Two Week' ? 'selected' : '' }}>withIn Two Week</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Color</label>
                                <select class="form-control" name="color">                                    
                                    <option class="form-control" value="White" {{ $product->color == 'White' ? 'selected' : '' }} >White</option>
                                    <option class="form-control" value="Green" {{ $product->color == 'Green' ? 'selected' : '' }} >Green</option>
                                    <option class="form-control" value="Gray" {{ $product->color == 'Gray' ? 'selected' : '' }} >Gray</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Other Color</label>
                                <input type="text" class="form-control" value="{{$product->other_colors}}" id="other_colors" name="other_colors" placeholder="Enter Other Color Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Upload Poduc Image</label>
                                <input type="file" name="image_url[]" class="file-upload-default" multiple>
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                                    <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="name"><strong>Product Size</strong></label>
                                <input type="text" class="form-control" id="size" name="size" value="{{$product_spec->size}}" placeholder="Product Size">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="name"><strong>Price</strong></label>
                                <input type="text" class="form-control" id="price" name="price" value="{{$product_spec->price}}" placeholder="Price">
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="name"><strong>Original Price</strong></label>
                                <input type="text" class="form-control" id="original_price" name="original_price" value="{{$product_spec->original_price}}" placeholder="Original Price">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="name"><strong>Discount</strong></label>
                                <input type="text" class="form-control" id="discount" name="discount" value="{{$product_spec->discount}}" placeholder="Discount">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="name"><strong>Height</strong></label>
                                <input type="text" class="form-control" id="height" name="height" value="{{$product_spec->height}}" placeholder="Height">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="name"><strong>Width</strong></label>
                                <input type="text" class="form-control" id="width" name="width" value="{{$product_spec->width}}" placeholder="Width">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="name"><strong>Length</strong></label>
                                <input type="text" class="form-control" id="length" name="length" value="{{$product_spec->length}}" placeholder="Length">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="name"><strong>Stock</strong></label>
                                <input type="text" class="form-control" id="stock" name="stock" value="{{$product_spec->stock}}" placeholder="Stock">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{route('product.index')}}" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 <a href="https://www.urbanui.com/" target="_blank">Urbanui</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted &amp; made with <i class="far fa-heart text-danger"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
 @stop
