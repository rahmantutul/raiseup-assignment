
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas fixed" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/dashboard') }}">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          @if (Auth::guard('admin')->user()->type=='admin')
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ '/admin/index' }}"> All Users </a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/update-password') }}">Change password </a></li>
              </ul>
            </div>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/job/index') }}">
              <i class="mdi mdi-file-document-box-outline menu-icon"></i>
              <span class="menu-title">Jobs</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->