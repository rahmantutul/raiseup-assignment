@extends('backend.layouts.app')
@push('css')
    
@endpush
@section('content')
        <div class="content-wrapper">
            <div class="col-md-6 grid-margin stretch-card m-auto">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Change password</h4>
                  <p class="card-description">
                    Update your password
                  </p>
                  <form class="forms-sample"  action="{{ url('admin/update-password') }}" method="POST">@csrf
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Email</label>
                      <div class="col-sm-9">
                        <input type="email" class="form-control" id="exampleInputUsername2" readonly value="{{ $adminInfo['email'] }}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Current password</label>
                      <div class="col-sm-9">
                        <input type="password" name="current" id="current" class="form-control" id="exampleInputPassword2" placeholder="Enter current password">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">New password</label>
                      <div class="col-sm-9">
                        <input type="password" name="new" id="new" class="form-control" id="exampleInputPassword2" placeholder="Enter new password">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Re Password</label>
                      <div class="col-sm-9">
                        <input type="password" name="confirm" id="confirm" class="form-control" id="exampleInputConfirmPassword2" placeholder="Re enter new password">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" id="submit">Submit</button>
                  </form>
                </div>
              </div>
            </div>
        </div>
@endsection
@push('css')
    
@endpush