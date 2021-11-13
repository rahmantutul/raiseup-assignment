@extends('backend.layouts.app')
@push('css')
    
@endpush
@section('content')
        <div class="content-wrapper">
            <div class="col-md-6 grid-margin stretch-card m-auto">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Job</h4>
                  @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
                  <form class="forms-sample" action="{{ url('admin/job/add') }}" method="POST" enctype="multipart/form-data">@csrf
                    <div class="form-group row">
                      <label for="Title" class="col-sm-3 col-form-label">Title</label>
                      <div class="col-sm-9">
                        <input type="text" name="title" class="form-control" id="Title">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Description" class="col-sm-3 col-form-label">Description</label>
                      <div class="col-sm-9">
                          <textarea name="description" class="form-control" id="Description"></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Thumbnail" class="col-sm-3 col-form-label">Thumbnail</label>
                      <div class="col-sm-9">
                        <input type="file" name="thumbnail" class="form-control" id="Thumbnail">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>
        </div>
@endsection
@push('script')
    
@endpush