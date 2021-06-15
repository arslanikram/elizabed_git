@extends('admin.layouts.app')

@section('content')
<div class="main-panel">        
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
                Edit SubCategory
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">SubCategory</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit SubCategory</li>
                </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit SubCategory</h4>
      
                  <form class="forms-sample" action="{{route('sub-categories.update', $subcategory->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PATCH')}}
                    <input type="hidden" name="id" value="{{$subcategory->id}}">
                    <div class="form-group">
                      <label for="exampleSelectGender">Select Category</label>
                        <select class="form-control" id="exampleSelectGender" name="category_id">
                          @foreach($categories as $category)
                          <option value="{{ $category->id }}" {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    <div class="form-group">
                      <label for="name">SubCategory Name</label>
                      <input type="text" class="form-control" value="{{$subcategory->name}}" id="name" name="name" placeholder="name">
                    </div>
                    <div class="form-group">
                          <img class="edit-img" src='{{env("ADMIN_ASSETS_PATH")."upload/images/subcategory/$subcategory->image_url"}}' alt="">
                    </div>
                    <div class="form-group">
                      <label>Update New SubCategory Image</label>
                      <input type="file" name="image_url" value="{{$subcategory->image_url}}" class="file-upload-default">

                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{url('admin/categories')}}" class="btn btn-light">Cancel</a>
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