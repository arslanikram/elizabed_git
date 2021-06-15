@extends('admin.layouts.app')

@section('content')
<div class="main-panel">        
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
                Edit Fabric Color
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Fabric Color</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit SubCategory</li>
                </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Fabric Color</h4>
                  @if (count($errors) > 0)
                      <ul class="alert alert-danger pl-5">
                          @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  @endif
      
                  <form class="forms-sample" action="{{route('fabric-color.update', $fbrcolor->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PATCH')}}
                    <input type="hidden" name="id" value="{{$fbrcolor->id}}">

                    <div class="form-group">
                      <label for="name">Fabric Name</label>
                      <select name="fabric_id" class="form-control">
                        <option value="">Select Fabric Name</option>
                        @foreach($fabrics as $fabric)
                        <option value="{{$fabric->id}}" {{ $fbrcolor->fabric_id == $fabric->id ? 'selected' : '' }} >{{$fabric->name}}</option>                        
                        @endforeach
                      </select>
                    </div>

                      <div class="form-group">
                          <label for="color_id">Fabric Color </label>
                          <select name="color_id" class="form-control" id="color_id">
                              <option value="">Select Fabric Color</option>
                              @foreach($colors as $color)
                                  <option value="{{$color->id}}" {{ $fbrcolor->color_id == $color->id ? 'selected' : '' }} >{{$color->name}}</option>
                              @endforeach
                          </select>
                      </div>

                    <div class="form-group">
                          <img class="edit-img" src='{{env("ADMIN_ASSETS_PATH")."upload/images/fabriccolor/$fbrcolor->image_url"}}' alt="">
                    </div>
                    <div class="form-group">
                      <label>Update New Fabric Color Image</label>
                      <input type="file" name="image_url" value="{{$fbrcolor->image_url}}" class="file-upload-default">

                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{url('admin/fabric-color')}}" class="btn btn-light">Cancel</a>
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
