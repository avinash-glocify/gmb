@php $projects =\App\Models\Project::get(); @endphp
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <div class="navbar p-0 d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex justify-content-center">
            <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
              <a class="navbar-brand brand-logo" href="#"><img src="/images/logo.svg" alt="logo"/></a>
              <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-sort-variant"></span>
              </button>
            </div>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('user-profile') }}">
        <i class="mdi mdi-account menu-icon"></i>
        <span class="menu-title">{{ Auth::user()->full_name }}</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/dashboard">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/users">
        <i class="mdi mdi-account-multiple menu-icon"></i>
        <span class="menu-title">Users</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="mdi mdi-file-document-box-outline menu-icon"></i>
        <span class="menu-title">Project</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('project-create') }}" id="createProject">Create New</a></li>
            @foreach($projects as $key => $project)
                <li class="nav-item"> <a class="nav-link" href="{{ route('project-setup', [$project->id])}}">{{ $project->name }}</a></li>
            @endforeach
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#setting" aria-expanded="false" aria-controls="setting">
        <i class="mdi mdi-settings menu-icon"></i>
        <span class="menu-title">Settings</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="setting">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('bussiness-index') }}" id="createProject">BussinessType</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('category-index') }}" id="createProject">Categories</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item" style="position:absolute; bottom:0px;">
      <a class="nav-link"  href="{{ route('logout') }}"
       onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
      <i class="mdi mdi-logout text-primary menu-icon"></i><span class="menu-title">Logout</span></a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
    </li>
  </ul>
</nav>
