<nav class="navbar header-navbar pcoded-header">
@guest
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    @if (Route::has('login'))
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="{{ route('login') }}">
            {{ __('Login') }}
        </a>
    </li>
    @endif

    @if (Route::has('register'))
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="{{ route('register') }}">
            {{ __('Register') }}
        </a>
    </li>
    @endif
  </ul>

  @else

  <div class="navbar-wrapper">
    <div class="navbar-logo">
      <a href="{{ url('patient/dashboard') }}">
        <img class="img-fluid" src="{{ asset('files/assets/images/pakar3.png') }}" width="150px" alt="Theme-Logo">
      </a>
      <a class="mobile-menu" id="mobile-collapse" href="#!">
        <i class="feather icon-menu icon-toggle-right"></i>
      </a>
      <a class="mobile-options waves-effect waves-light">
        <i class="feather icon-more-horizontal"></i>
      </a>
    </div>
    <div class="navbar-container container-fluid">
      <ul class="nav-left">
        <li class="header-search">
          <div class="main-search morphsearch-search">
            <div class="input-group">
              <span class="input-group-prepend search-close">
                <i class="feather icon-x input-group-text"></i>
              </span>
              <input type="text" class="form-control" placeholder="Enter Keyword">
              <span class="input-group-append search-btn">
                <i class="feather icon-search input-group-text"></i>
              </span>
            </div>
          </div>
        </li>
        <li>
          <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
            <i class="full-screen feather icon-maximize"></i>
          </a>
        </li>
      </ul>
      <ul class="nav-right">
        <li class="header-notification">
          <div class="dropdown-primary dropdown">
            <div class="dropdown-toggle" data-toggle="dropdown">
              <i class="feather icon-bell"></i>
              <span class="badge bg-c-red">5</span>
            </div>
            <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
              <li>
                <h6>Notifications</h6>
                <label class="label label-danger">New</label>
              </li>
              <li>
                <div class="media">
                  <img class="img-radius" src="{{ asset('files/assets/images/avatar-4-1.jpg') }}" alt="Generic placeholder image">
                  <div class="media-body">
                    <h5 class="notification-user">John Doe</h5>
                    <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                    <span class="notification-time">30 minutes ago</span>
                  </div>
                </div>
              </li>
              <li>
                <div class="media">
                  <img class="img-radius" src="{{ asset('files/assets/images/avatar-3-1.jpg') }}" alt="Generic placeholder image">
                  <div class="media-body">
                    <h5 class="notification-user">Joseph William</h5>
                    <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                    <span class="notification-time">30 minutes ago</span>
                  </div>
                </div>
              </li>
              <li>
                <div class="media">
                  <img class="img-radius" src="{{ asset('files/assets/images/avatar-4-1.jpg') }}" alt="Generic placeholder image">
                  <div class="media-body">
                    <h5 class="notification-user">Sara Soudein</h5>
                    <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                    <span class="notification-time">30 minutes ago</span>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </li>

        <li class="header-notification">
          <div class="dropdown-primary dropdown">
            <div class="displayChatbox dropdown-toggle" data-toggle="dropdown">
              <i class="feather icon-message-square"></i>
              <span class="badge bg-c-green">3</span>
            </div>
          </div>
        </li>
        <li class="user-profile header-notification">
          <div class="dropdown-primary dropdown">
            <div class="dropdown-toggle" data-toggle="dropdown">
              
              <div class="d-flex justify-content-center align-items-center" style="margin-top: -2px">
                <!-- pic shown here -->
                <div class="parent-container">
                  <div class="pic-holder" style="background-image: url({{ Auth::user()->image ? asset('storage/profilePic/' . Auth::user()->image) : asset('files/assets/images/profilePic/unknown.jpg') }});">
                  </div>
                </div>
                <span class="ml-2">{{ Auth::user()->name }}</span>
                <i class="feather icon-chevron-down"></i>
              </div>

            </div>
            <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
              <li>
                <a href="/patient/profile">
                  <i class="feather icon-user"></i> Profile
                </a>
              </li>
             
              <li>

                <a href="{{ route('logout') }}" onclick="event.preventDefault(); 
                document.getElementById('logout-form').submit();">
                  <i class="feather icon-log-out"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
              </form>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
@endguest