@extends('backend.layouts.app')
@push('css')
    
@endpush
@section('content')
        <div class="content-wrapper">
            <div class="col-md-9 grid-margin stretch-card m-auto">
              <div class="card text-center">
                  <div class="card-header">
                     <h3 style="margin-top:12px">{{ $singleJob['title'] }}</h3>
                  </div>
                <div class="card-body">
                    <h2>Job details</h2>
                    <p>{{ $singleJob['description'] }}</p>
                    <img style="height: 200px; width:300px; margin-top:40px" src="{{ asset('storage/images/job/'.$singleJob['thumbnail']) }}" alt="No image">
                </div>
              </div>
            </div>
        </div>
@endsection
@push('script')
    
@endpush