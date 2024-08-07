  {{-- <style>
      .main-header {

          background: linear-gradient(279deg, rgba(218, 165, 32, 1) 26%, rgba(255, 255, 255, 1) 100%);
      }
  </style> --}}

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <a href="index3.html" class="nav-link">Home</a>
          </li>

      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#" id="notification-count">
                  <i class="far fa-bell"></i>
                  <span class="badge badge-warning navbar-badge" ></span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="dropdown-menu">
                  <span class="dropdown-item dropdown-header" id="notification-header">0 Notifications</span>
                  <div id="notifications-container">
                      <!-- Dynamic notifications will be appended here -->
                  </div>
                  <div class="dropdown-divider"></div>
                  <a href="{{route('notification.index')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
              </div>
          </li>


          <!-- profille Dropdown Menu -->
          <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                  <div class="image">
                      <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" class="img-circle elevation-2"
                          alt="User Image" style="height: 30px; width: 30px;">
                  </div>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">


                  <a href="{{ route('profile.edit', Crypt::encrypt(auth()->user()->id)) }}" class="dropdown-item">
                      <i class="fa fa-cog mr-2" aria-hidden="true"></i>
                      Settings
                  </a>

                  <form action="{{ route('logout') }}" method="POST">
                      @csrf
                      <button type="submit" class="dropdown-item">
                        <i class="fa fa-sign-out-alt mr-2" ></i>
                          Log out
                      </button>
                  </form>




              </div>

          </li>


          {{--  <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li> --}}
          {{--  <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li> --}}
      </ul>
  </nav>
  <!-- /.navbar -->
