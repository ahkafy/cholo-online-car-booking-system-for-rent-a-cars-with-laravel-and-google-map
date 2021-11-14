<!-- Main Sidebar Container elevation-4 -->
  <aside class="main-sidebar sidebar-light-primary ">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('dist/img/logo.svg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

<!--Application Daily Operation Menu-->
          <li class="nav-header text-capitalize"><i class="nav-icon nav-icon fas fa-folder-plus text-dark "></i> {{ Auth::user()->type }} menu</li>

<!--Admin Menu-->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link"><i class="nav-icon fas fa-ship"></i> <p>Trip Manager<i class="fas fa-angle-left right"></i></p></a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/trips/pending') }}" class="nav-link"><i class="far fa-circle nav-icon text-dark"></i><p>Pending Trips</p></a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/trips/scheduled') }}" class="nav-link"><i class="far fa-circle nav-icon text-dark"></i><p>Scheduled Trips</p></a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/trips/complete') }}" class="nav-link"><i class="far fa-circle nav-icon text-dark"></i><p>Complete Trips</p></a>
              </li>

              <li class="nav-item">
                <a href="{{ url('admin/trips/all') }}" class="nav-link"><i class="far fa-circle nav-icon text-dark"></i><p>All Trips</p></a>
              </li>
            </ul>
          </li>


          <!--Admin Menu-->
                    <li class="nav-item has-treeview">
                      <a href="#" class="nav-link"><i class="nav-icon fas fa-ship"></i> <p>Ride & Rider<i class="fas fa-angle-left right"></i></p></a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="{{ url('admin/owners') }}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Owners</p></a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/riders') }}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Riders</p></a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/rides') }}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Rides</p></a>
                        </li>
                      </ul>
                    </li>


<!--Ends : Application Daily Operation Menu-->

          <li class="nav-header"><i class="nav-icon nav-icon fas fa-folder-plus text-dark"></i> Configuration</li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon nav-icon fas fa-cog text-dark"></i>
              <p>
                Setup
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('expenses/categories') }}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Owners/Riders</p></a>
              </li>



            </ul>
          </li>


          <!-- user menu -->
          <li class="nav-header"><i class="nav-icon nav-icon fas fa-folder-plus text-dark"></i> User</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon nav-icon fas fa-user-cog text-dark"></i>
              <p>My Account</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon nav-icon fas fa-key text-dark"></i>
              <p>Chnage Password</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
              <i class="nav-icon nav-icon fas fa-sign-out-alt text-dark"></i> <p> {{ __('Logout') }} </p>
            </a>

            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
