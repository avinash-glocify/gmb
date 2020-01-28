@php $projects =\App\Models\Project::get(); @endphp
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#logout" aria-expanded="false" aria-controls="logout">
        <i class="mdi mdi-account menu-icon"></i>
        <span class="menu-title">{{ Auth::user()->full_name }}</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="logout">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link"  href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
            <i class="mdi mdi-logout text-primary"></i>Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </div>
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
          <li class="nav-item"> <a class="nav-link" href="{{ route('create-bussiness') }}" id="createProject">Add BussinessType</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('create-category') }}" id="createProject">Add Category</a></li>
        </ul>
      </div>
    </li>
  </ul>
</nav>
