@extends('backend.layouts.app')
@push('css')
    
@endpush
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Users Table</h4>
                  <a href="{{ url('/admin/add') }}">Add new User</a>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            User
                          </th>
                          <th>
                            Name
                          </th>
                          <th>
                            Email
                          </th>
                          <th>
                            Role
                          </th>
                          <th>
                            Actions
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($admins as $admin)
                        <tr>
                          <td class="py-1">
                            <img src="{{ asset('storage/images/admin/'.$admin['image']) }}" alt="image"/>
                          </td>
                          <td>
                           {{ $admin['name'] }}
                          </td>
                          <td>
                            {{ $admin['email'] }}
                          </td>
                          <td>
                           {{ $admin['type'] }}
                          </td>
                          <td>
                          <h4>
                          @if ($admin['id']!==1)
                          <a class="confirmDelete" href="{{ url('/admin/delete-admin',$admin['id']) }}" name="user" title="Delete"><i class="mdi mdi-delete-forever"></i></a>
                          @endif

                           <a href="{{ url('/admin/setting',$admin['id']) }}" title="Edit"><i class="mdi mdi-table-edit"></i></a>

                          @if ($admin['status']==1)
                           <a href="javascript:void(0)" class="updateAdminStatus" id="admin-{{ $admin['id'] }}" admin_id="{{ $admin['id'] }}" title="Turn Off"><i class="mdi mdi-toggle-switch" status="Active"></i></a> 
                            @else
                           <a href="javascript:void(0)" class="updateAdminStatus" id="admin-{{ $admin['id'] }}" admin_id="{{ $admin['id'] }}" title="Turn On"><i class="mdi mdi-toggle-switch-off" status="Disabled"></i></a>
                          @endif
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