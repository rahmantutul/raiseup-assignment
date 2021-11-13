@extends('backend.layouts.app')
@push('css')
    
@endpush
@section('content')
        <div class="content-wrapper">
            <div class="col-md-6 grid-margin stretch-card m-auto">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add admin</h4>
                  <p class="card-description">
                    Insert new Admin
                  </p>
                  <form class="forms-sample" action="{{ url('/admin/add') }}" method="POST" enctype="multipart/form-data">@csrf
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Email</label>
                      <div class="col-sm-9">
                        <input type="email" name="email" class="form-control" id="exampleInputUsername2">
                      </div>
                    </div>
                     <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Type</label>
                      <div class="col-sm-9">
                        <select name="type" id="" class="form-control">
                          <option>Select</option>
                          <option value="admin">Admin</option>
                          <option value="general">General</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Name</label>
                      <div class="col-sm-9">
                        <input type="name" name="name" class="form-control" id="exampleInputEmail2">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Image</label>
                      <div class="col-sm-9">
                        <input type="file" name="image" class="form-control" id="exampleInputEmail2">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Mobile</label>
                      <div class="col-sm-9">
                        <input type="text" name="phone" class="form-control" id="exampleInputMobile">
                      </div>
                    </div>
                     <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Login password</label>
                      <div class="col-sm-9">
                        <input type="password" name="password" class="form-control" id="exampleInputMobile">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>
        </div>
@endsection
@push('css')
    
@endpush