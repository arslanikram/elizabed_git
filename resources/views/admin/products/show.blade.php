@extends('admin.layouts.app')
@section('content')
    <style>
        tr > td {
            padding: 10px;
        }
    </style>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    Product Details
                </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin/product')}}">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View Product</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">View Product</h4>

                            <div class="row">
                                <div class="col-md-4">
                                    <h5>Product Name</h5>
                                    <p>{{$product->product_name}}</p>
                                </div>
                                <div class="col-md-4">
                                    <h5>Category</h5>
                                    <p>
                                        @foreach($categories as $category)
                                            @if($product->category_id == $category->id)
                                                {{$category->name}}
                                            @endif
                                        @endforeach
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <h5>SubCategory</h5>
                                    <p>
                                        @foreach($sub_categories as $sub_categorie)
                                            @if($product->subcategory_id == $sub_categorie->id)
                                                {{$sub_categorie->name}}
                                            @endif
                                        @endforeach
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <h5>Delivery Time</h5>
                                    <p>{{$product->delivery_time}}</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Color</h5>
                                        <p>{{$product->color}}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Other Color</h5>
                                        <p>{{$product->other_colors}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Description</h5>
                                    <p>{{$product->description}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Product Images</h5>
                                </div>
                                @foreach($product_images as $image)
                                    <?php //echo "<pre>"; print_r($image); die(); ?>
                                    @if(!empty($image->image_url))
                                    <div class="col-md-3">
                                        <img src="{{env("ADMIN_ASSETS_PATH")."upload/images/products/$image->image_url"}}" alt="{{$image->image_url}}" style="width: 250px;height: 200px;padding: 20px;">
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Product Specifications:</h5>
                                    <hr>
                                    <table style="width: 100%">
                                        <thead>
                                        <tr>
                                            <th>Product Size</th>
                                            <th>Price</th>
                                            <th>Original Price</th>
                                            <th>Discount</th>
                                            <th>Height</th>
                                            <th>Width</th>
                                            <th>Length</th>
                                            <th>Stock</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr style="background: #ececec; height: 50px; padding: 10px!important;">
                                            <td> {{$product_spec->size}}</td>
                                            <td> {{$product_spec->price}}</td>
                                            <td> {{$product_spec->original_price}}</td>
                                            <td> {{$product_spec->discount}}</td>
                                            <td> {{$product_spec->height}}</td>
                                            <td> {{$product_spec->width}}</td>
                                            <td> {{$product_spec->length}}</td>
                                            <td> {{$product_spec->stock}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 <a
                        href="https://www.urbanui.com/" target="_blank">Urbanui</a>. All rights reserved.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted &amp; made with <i
                        class="far fa-heart text-danger"></i></span>
            </div>
        </footer>
        <!-- partial -->
    </div>
@stop
