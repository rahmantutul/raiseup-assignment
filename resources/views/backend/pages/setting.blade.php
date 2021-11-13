@extends('backend.layouts.app')
@push('css')
    
@endpush
@section('content')
        <div class="content-wrapper">
            <div class="col-md-6 grid-margin stretch-card m-auto">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Change Info</h4>
                  <p class="card-description">
                    Update your information
                  </p>
                  <form class="forms-sample" action="{{ url('admin/setting',$adminInfo['id']) }}" method="POST" enctype="multipart/form-data">@csrf
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Email</label>
                      <div class="col-sm-9">
                        <input type="email" class="form-control" id="exampleInputUsername2" readonly value="{{ $adminInfo['email'] }}">
                      </div>
                    </div>
                     <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Role</label>
                      <div class="col-sm-9">
                        <input type="email" class="form-control" id="exampleInputEmail2" value="{{ $adminInfo['type'] }}" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Name</label>
                      <div class="col-sm-9">
                        <input type="name" name="name" class="form-control" id="exampleInputEmail2" value="{{ $adminInfo['name'] }}">
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
                        <input type="text" name="phone" class="form-control" id="exampleInputMobile" value="{{ $adminInfo['phone'] }}">
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