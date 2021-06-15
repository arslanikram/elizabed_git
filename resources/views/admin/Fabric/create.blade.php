@extends('admin.layouts.app')

@section('content')
<div class="main-panel">        
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
                Create Fabric
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Fabrics</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create New Fabric</li>
                </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add New Fabric</h4>
                  @if (count($errors) > 0)
                      <ul class="alert alert-danger pl-5">
                          @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  @endif
      
                  <form class="forms-sample" action="{{route('fabric.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="name">Fabric Name</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="name">
                    </div>
                  
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{route('fabric.index')}}" class="btn btn-light">Cancel</a>
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