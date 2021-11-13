@extends('backend.layouts.app')
@push('css')
    
@endpush
@section('content')
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="mr-md-3 mr-xl-5">
                    <h2>Welcome back [{{Auth::guard('admin')->user()->name}}]</h2>
                    <p class="mb-md-0">Your analytics dashboard template.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection
@push('css')
    
@endpush