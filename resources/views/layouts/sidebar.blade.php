@php $projects =\App\Models\Project::get(); @endphp
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="/dashboard">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/users">
        <i class="mdi mdi-home menu-icon"></i>
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
  </ul>
</nav>
