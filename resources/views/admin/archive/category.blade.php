@extends('admin.layouts.app')
@section('content')
<div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Categories table
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <a href="{{url('admin/categories/create')}}" class="btn btn-primary btn-sm">Create New</a>
              </ol>
            </nav>
          </div>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Categories table</h4>
              <div class="row">
                <div class="col-12">
                   @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{Session::get('success')}}
                        </div>
                    @elseif(Session::has('fail'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{Session::get('fail')}}
                        </div>
                    @endif
                  <div class="table-responsive">
                    <div id="order-listing_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                      
                      <div class="row">
                        <div class="col-sm-12">
                          <table id="order-listing" class="table dataTable no-footer" role="grid" aria-describedby="order-listing_info">
                      <thead>
                        <tr role="row">

                          <th class="sorting_asc" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Order #: activate to sort column descending" style="width: 54px;">Sr No#</th>
                          <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Purchased On: activate to sort column ascending" style="width: 97px;">Category Name</th>
                          <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Purchased On: activate to sort column ascending" style="width: 97px;">Category Image</th>
                          <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 60px;">Status</th>
                          <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 57px;">Actions</th></tr>
                      </thead>
                      <tbody>
                        <?php $counter = 1; ?>
                        @foreach($categories as $category)
                        <tr role="row" class="odd">
                            <td class="sorting_1">{{$counter}}</td>
                            <td>{{ $category->name }}</td>
                            <td><img src='{{env("ADMIN_ASSETS_PATH")."upload/images/category/$category->image_url"}}' alt=""></td>
                            <td>
                              @if($category->status == 'Active')
                              <label class="badge badge-success">Active</label>
                              @else
                               <label class="badge badge-danger">Inactive</label>
                              @endif
                            </td>
                            <td>
                              <a href="{{route('categories.edit',$category->id)}}" class="btn btn-outline-primary">Edit</a>
                              @if($category->status == 'Active')
                              <a onclick="return confirm('Are you sure to make this Inactive ?')" href="{{url('admin/categories/status-inactive/'.$category->id)}}" class="btn btn-outline-danger">Inactive</a>
                              @else
                              <a onclick="return confirm('Are you sure to make this Aactive ?')" href="{{url('admin/categories/status-active/'.$category->id)}}" class="btn btn-outline-success">Active</a>
                              @endif
                            </td>
                        </tr>
                        <?php $counter++; ?>
                        @endforeach

                      </tbody>
                    </table>
                  </div>
                </div>
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
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 <a href="https://www.urbanui.com/" target="_blank">Urbanui</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted &amp; made with <i class="far fa-heart text-danger"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      @stop