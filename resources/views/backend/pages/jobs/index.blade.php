@extends('backend.layouts.app')
@push('css')
    
@endpush
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">All jobs</h4>
                  @if (Auth::guard('admin')->user()->type=='admin')
                  <a href="{{ url('admin/job/add') }}">Add new Jobs</a>
                  @endif
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Thumbnail
                          </th>
                          <th>
                            Title
                          </th>
                          <th>
                            Description
                          </th>
                          <th>
                            User who posted
                          </th>
                          <th>
                            Actions
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($jobs as $job)
                        <tr>
                          <td class="py-1">
                            <img src="{{ asset('storage/images/job/'.$job['thumbnail']) }}" alt="image"/>
                          </td>
                          <td>
                           {{ $job['title'] }}
                          </td>
                          <td>
                            {{ Str::limit($job['description'], 50) }}
                          </td>
                          <td>
                            {{ $job['user']['name'] }}
                          </td>
                          <td>
                          <h4>
                          @if (Auth::guard('admin')->user()->type=='admin')
                              <a class="confirmDelete" href="{{ url('admin/job/delete',$job['id']) }}" name="job" title="Delete"><i class="mdi mdi-delete-forever"></i></a>
                              <a href="{{ url('admin/job/edit',$job['id']) }}" title="Edit"><i class="mdi mdi-table-edit"></i></a> 
                              @if ($job['status']==1)
                              <a href="javascript:void(0)" class="updateJobStatus" id="job-{{ $job['id'] }}" job_id="{{ $job['id'] }}" title="Turn Off"><i class="mdi mdi-toggle-switch" status="Active"></i></a> 
                                @else
                              <a href="javascript:void(0)" class="updateJobStatus" id="job-{{ $job['id'] }}" job_id="{{ $job['id'] }}" title="Turn On"><i class="mdi mdi-toggle-switch-off" status="Disabled"></i></a> 
                              @endif
                          @endif
                          <a href="{{ url('admin/job/single',$job['id']) }}"title="View this job"><i class="mdi mdi-eye"></i></a>
                          </h4>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
@endsection
@push('css')
    
@endpush