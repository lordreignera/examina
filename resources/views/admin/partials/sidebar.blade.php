<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top" style="padding: 10px;">
    <a class="sidebar-brand brand-logo" href="{{ route('admin.dashboard') }}" style="display: flex; align-items: center; width: 100%;">
      <img src="{{ asset('examina log.jpeg') }}" alt="EXAMINA Laboratory" style="height: 45px; width: auto; object-fit: contain; background: white; padding: 5px; border-radius: 8px;">
      <span class="text-white ms-2" style="font-size: 0.9rem; font-weight: 600;">Lab</span>
    </a>
    <a class="sidebar-brand brand-logo-mini" href="{{ route('admin.dashboard') }}" style="display: none; align-items: center; justify-content: center; width: 100%;">
      <img src="{{ asset('examina log.jpeg') }}" alt="EXAMINA" style="height: 40px; width: auto; object-fit: contain; background: white; padding: 3px; border-radius: 5px;">
    </a>
  </div>
  <ul class="nav">
    <li class="nav-item profile">
      <div class="profile-desc">
        <div class="profile-pic">
          <div class="count-indicator">
            <img class="img-xs rounded-circle" src="/admin/assets/images/faces/face15.jpg" alt="">
            <span class="count bg-success"></span>
          </div>
         <!-- <div class="profile-name">
            <h5 class="mb-0 font-weight-normal">{{ Auth::user()->name }}</h5>
            <span>Super Administrator</span>
          </div> -->
        </div>
        <a href="#" id="profile-dropdown" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
          <a href="{{ route('profile.show') }}" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-settings text-primary"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" class="dropdown-item preview-item"
               onclick="event.preventDefault(); this.closest('form').submit();">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-logout text-danger"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">Logout</p>
              </div>
            </a>
          </form>
        </div>
      </div>
    </li>
   <!-- <li class="nav-item nav-category">
      <span class="nav-link">Navigation</span>
    </li> -->
    <li class="nav-item menu-items {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.dashboard') }}">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item menu-items {{ request()->routeIs('admin.branches.*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.branches.index') }}">
        <span class="menu-icon">
          <i class="mdi mdi-hospital-building"></i>
        </span>
        <span class="menu-title">Branches</span>
      </a>
    </li>
    <li class="nav-item menu-items {{ request()->routeIs('admin.lab-tests.*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.lab-tests.index') }}">
        <span class="menu-icon">
          <i class="mdi mdi-flask"></i>
        </span>
        <span class="menu-title">Lab Tests</span>
      </a>
    </li>
    <li class="nav-item menu-items {{ request()->routeIs('admin.test-categories.*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.test-categories.index') }}">
        <span class="menu-icon">
          <i class="mdi mdi-format-list-bulleted"></i>
        </span>
        <span class="menu-title">Test Categories</span>
      </a>
    </li>
    <li class="nav-item menu-items {{ request()->routeIs('admin.specimen-types.*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.specimen-types.index') }}">
        <span class="menu-icon">
          <i class="mdi mdi-test-tube"></i>
        </span>
        <span class="menu-title">Specimen Types</span>
      </a>
    </li>
    <li class="nav-item menu-items {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.orders.index') }}">
        <span class="menu-icon">
          <i class="mdi mdi-calendar-check"></i>
        </span>
        <span class="menu-title">Test Schedules</span>
      </a>
    </li>
  </ul>
</nav>
