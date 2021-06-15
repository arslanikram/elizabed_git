@extends('admin.layouts.app')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    Create Product
                </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create New Product</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add New Product</h4>
                            @if (count($errors) > 0)
                                <ul class="alert alert-danger pl-5">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <form class="forms-sample" action="{{route('product.store')}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name"><strong>Category</strong></label>
                                            <select class="form-control" name="category_id" id="category">
                                                <option class="form-control" value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option class="form-control"
                                                            value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name"><strong>SubCategory</strong></label>
                                            <select class="form-control" name="subcategory_id"
                                                    id="sub_category_options">
                                                <option class="form-control" value="">Select subCategory</option>
                                                @foreach($sub_categories as $sub_categorie)
                                                    <option class="form-control"
                                                            value="{{$sub_categorie->id}}">{{$sub_categorie->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name"><strong>Product Name</strong></label>
                                            <input type="text" class="form-control" id="product_name"
                                                   name="product_name" placeholder="Enter Product Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name"><strong>Description</strong></label>

                                            <textarea class="form-control" id="summary-ckeditor" name="description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name"><strong>Delivery Time</strong></label>
                                            <!-- <input type="text" class="form-control" id="color_name" name="color_name" placeholder="Color Name"> -->
                                            <select class="form-control" name="delivery_time">
                                                <option class="form-control" value="">Select Delivery Time</option>
                                                <option class="form-control" value=" withIn One Week">withIn One Week
                                                </option>
                                                <option class="form-control" value="withIn Two Week">withIn Two Week
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Upload Poduc Image</label>
                                            <input type="file" name="image_url[]" class="file-upload-default" multiple>
                                            <div class="input-group col-xs-12">
                                                <input type="text" class="form-control file-upload-info" disabled=""
                                                       placeholder="Upload Image">
                                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name"><strong>Colors</strong></label>
                                            <br>
                                            <span style="margin-left: 10px">
                                            <input type="radio" name="color_option" value="Yes" id="colors"> Yes
                                            <input type="radio" name="color_option" value="No" id="no_color"> No
                                            <input type="radio" name="color_option" value="Others" id="other_color"> Others
                                                </span>
                                        </div>
                                    </div>

                                    <div class="col-md-12"  id="select_color" style="display: none">
                                        <div class="form-group">
                                            <label for="select_fabric"><strong>Select Fabric</strong></label>
                                            <select name="fabric" id="select_fabric" class="form-control">
                                                <option value="">Select</option>
                                                @if(!empty($fabrics))
                                                    @foreach($fabrics as $fabric)
                                                        <option value="{{$fabric->id}}">{{$fabric->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12"  id="other_color_input" style="display: none">
                                        <div class="form-group">
                                            <label for="other_color"><strong>Other Color</strong></label>
                                            <input type="text" name="other_color" id="other_color" class="form-control other_color_input">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group" id="fabric_color_new_html" style="margin-left: 15px">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="name"><strong>Product Size</strong></label>
                                            <input type="text" class="form-control" id="size" name="size"
                                                   placeholder="Product Size">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="name"><strong>Price</strong></label>
                                            <input type="text" class="form-control" id="price" name="price"
                                                   placeholder="Price">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="name"><strong>Original Price</strong></label>
                                            <input type="text" class="form-control" id="original_price"
                                                   name="original_price" placeholder="Original Price">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="name"><strong>Discount</strong></label>
                                            <input type="text" class="form-control" id="discount" name="discount"
                                                   placeholder="Discount">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="name"><strong>Height</strong></label>
                                            <input type="text" class="form-control" id="height" name="height"
                                                   placeholder="Height">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="name"><strong>Width</strong></label>
                                            <input type="text" class="form-control" id="width" name="width"
                                                   placeholder="Width">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="name"><strong>Length</strong></label>
                                            <input type="text" class="form-control" id="length" name="length"
                                                   placeholder="Length">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="name"><strong>Stock</strong></label>
                                            <input type="text" class="form-control" id="stock" name="stock"
                                                   placeholder="Stock">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="{{route('fabric-color.index')}}" class="btn btn-light">Cancel</a>
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
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 <a
                        href="https://www.urbanui.com/" target="_blank">Urbanui</a>. All rights reserved.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted &amp; made with <i
                        class="far fa-heart text-danger"></i></span>
            </div>
        </footer>
        <!-- partial -->
    </div>

    <script>
        $(document).on('change', '#category', function () {
            var category_id = $('#category').val();
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '<?= url('admin/product/get_subCategory') ?>',
                data: {category_id: category_id, _token: token},
                type: 'POST',
                dataType: "json",
                success: function (res) {
                    var sub_category_html = '';
                    if (!$.trim(res)) {
                        sub_category_html = '<option class="form-control" value="">Select</option>';
                    } else {
                        $.each(res, function (key, value) {
                            sub_category_html +=
                                '<option class="form-control" value="' + value.id + '">' + value.name + '</option>';
                        });
                    }
                    $('#sub_category_options').html(sub_category_html);
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#colors").click(function () {
                $("#select_color").show();
                $("#fabric_color_new_html").show();
                $("#other_color_input").hide();
            });

            $("#no_color").click(function () {
                $('#select_fabric').prop('selectedIndex',0);
                $("#select_color").hide();
                $(".other_color_input").val('');
                $("#other_color_input").hide();
                $("#fabric_color_new_html").hide();
            });

            $("#other_color").click(function () {
                $("#select_color").hide();
                $("#other_color_input").show();
                $("#fabric_color_new_html").hide();
            });
        });

        $(document).ready(function () {
           $('#select_fabric').change(function () {
              var fabric_id = $(this).val();
               var token = $('meta[name="csrf-token"]').attr('content');
               $.ajax({
                   url: '<?= url('admin/product/get_fabric_color') ?>',
                   data: {fabric_id: fabric_id, _token: token},
                   type: 'POST',
                   dataType: "json",
                   success: function (res) {
                       console.log(res)
                       var fabric_color_html = '<label for="name"> <strong>Select Colors </strong> </label><br>';
                       if (!$.trim(res)) {
                           fabric_color_html = '<p style="color:red;">This Fabric has No Color</p>';
                       } else {

                           $.each(res, function (key, value) {
                               fabric_color_html +=

                                   ' <input type="checkbox" name="colors[]" value="' + value.id + '"> '+ value.name ;
                           });
                       }
                       $('#fabric_color_new_html').html(fabric_color_html);
                   }
               });

           });
        });

    </script>
@stop


