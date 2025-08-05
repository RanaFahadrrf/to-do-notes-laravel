@extends('layout')

@section('title', 'Admin CRM Dashboard')

@section('content')
<style>
    .crm-sidebar {
        height: 100vh;
        background-color: #212529;
        color: white;
        padding-top: 1rem;
    }
    .crm-sidebar a {
        color: #adb5bd;
        padding: 0.75rem 1rem;
        display: block;
        text-decoration: none;
    }
    .crm-sidebar a:hover,
    .crm-sidebar a.active {
        background-color: #343a40;
        color: white;
    }
    .dashboard-card {
        border-left: 4px solid;
        border-radius: 0.5rem;
        padding: 1rem;
        color: #fff;
    }
    .dashboard-card h5 {
        font-size: 1.1rem;
    }
</style>

<div class="container-fluid">
    <div class="row">
        {{-- <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 crm-sidebar">
            <h4 class="text-center mb-4"><i class="bi bi-kanban-fill me-1"></i>To-Do CRM</h4>
            <a href="#" class="active"><i class="bi bi-house-door-fill me-2"></i> Dashboard</a>
            <a href="#"><i class="bi bi-person-lines-fill me-2"></i> Users</a>
            <a href="#"><i class="bi bi-card-checklist me-2"></i> Tasks</a>
            <a href="#"><i class="bi bi-gear-fill me-2"></i> Settings</a>
            <a href="{{ route('logout') }}"><i class="bi bi-box-arrow-left me-2"></i> Logout</a>
        </div> --}}
        <!-- Sidebar -->
<div class="col-md-3 col-lg-2 crm-sidebar">
    <h4 class="text-center mb-4"><i class="bi bi-kanban-fill me-1"></i>To-Do CRM</h4>

    <div class="accordion" id="crmMenu">

        <!-- Dashboard -->
        <div class="accordion-item bg-transparent border-0">
            <h2 class="accordion-header" id="headingDashboard">
                <a href="#" class="accordion-button collapsed bg-transparent text-white shadow-none px-0 py-2" type="button">
                    <i class="bi bi-house-door-fill me-2"></i> Dashboard
                </a>
            </h2>
        </div>

          

        <!-- Management Section -->
        <div class="accordion-item bg-transparent border-0">
            <h2 class="accordion-header" id="headingManage">
                <button class="accordion-button collapsed bg-transparent text-white shadow-none px-0 py-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseManage" aria-expanded="false">
                    <i class="bi bi-folder2-open me-2"></i> Management
                </button>
            </h2>
            <div id="collapseManage" class="accordion-collapse collapse" data-bs-parent="#crmMenu">
                <div class="accordion-body px-0">
                    {{-- <a href="#" class="ps-4"><i class="bi bi-person-lines-fill me-2"></i> Users</a> --}}
                      <button type="button" class="btn btn-warning mb-3" data-bs-toggle="modal" data-bs-target="#userRequestsModal">
                            Users
                        </button>

                  <!-- Modal -->
<div class="modal fade" id="userRequestsModal" tabindex="-1" aria-labelledby="userRequestsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    
      <div class="modal-header">
        <h5 class="modal-title" id="userRequestsModalLabel">Users</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        @if($stats['all_users']->isEmpty())
            <p class="text-muted">No users.</p>
        @else
            <table class="table table-bordered align-middle text-center">
              <thead class="table-light">
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Total Notes</th>
                </tr>
              </thead>
              <tbody>
                @foreach($stats['all_users'] as $request)
                  <tr>
                    <td>{{ $request->name }}</td>
                    <td>{{ $request->email }}</td>
                    <td>{{ $request->notes_count}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
        @endif
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

                    {{-- <a href="#" class="ps-4"><i class="bi bi-person-lines-fill me-2"></i> User Requests</a> --}}
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewRequestsModal">
                        User Requests
                            </button>

                  <!-- Modal -->
<div class="modal fade" id="viewRequestsModal" tabindex="-1" aria-labelledby="viewRequestsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    
      <div class="modal-header">
        <h5 class="modal-title" id="viewRequestsModalLabel">User Requests</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        @if($stats['requests']->isEmpty())
            <p class="text-muted">No user requests at the moment.</p>
        @else
            <table class="table table-bordered align-middle text-center">
              <thead class="table-light">
                <tr>
                  <th>User-Name</th>
                  <th>Email</th>
                  <th>Request</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($stats['requests'] as $request)
                  <tr>
                    <td>{{ $request->user->name }}</td>
                    <td>{{ $request->user->email }}</td>
                    {{-- <td>{{ $request->message ?? '—' }}</td> --}}
                    <td>{{ $request->title}}</td>
                    <td>
                      <form action="{{ route('admin-approval' , $request->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                      </form>
                      {{-- <form action="" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Ignore</button>
                      </form> --}}
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
        @endif
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

                    <a href="#" class="ps-4"><i class="bi bi-card-checklist me-2"></i> Tasks</a>
                </div>
            </div>
        </div>

        <!-- Settings -->
        <div class="accordion-item bg-transparent border-0">
            <h2 class="accordion-header" id="headingSettings">
                <a href="{{ route('admin-settings') }}" class="accordion-button collapsed bg-transparent text-white shadow-none px-0 py-2" type="button">
                    <i class="bi bi-gear-fill me-2"></i> Settings
                </a>
            </h2>
        </div>

        <!-- Logout -->
        <div class="accordion-item bg-transparent border-0">
            <h2 class="accordion-header" id="headingLogout">
                <a href="{{ route('admin-logout') }}" class="accordion-button collapsed bg-transparent text-white shadow-none px-0 py-2" type="button">
                    <i class="bi bi-box-arrow-left me-2"></i> Logout
                </a>
            </h2>
        </div>

    </div>
</div>



        <!-- Main Dashboard -->
        <div class="col-md-9 col-lg-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">Dashboard</h2>
                <span class="badge bg-success">Admin Panel</span>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="dashboard-card bg-primary shadow">
                        <h5><i class="bi bi-people-fill me-2"></i>Total Users</h5>
                        <h3>{{ $stats['total_users'] }}</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="dashboard-card bg-success shadow">
                        <h5><i class="bi bi-card-checklist me-2"></i>Total Tasks</h5>
                        <h3>587</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="dashboard-card bg-warning shadow">
                        <h5><i class="bi bi-check2-circle me-2"></i>Completed Tasks</h5>
                        <h3>460</h3>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-info text-white">
                            <i class="bi bi-person-lines-fill me-1"></i> Recent Users
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($stats['recent_users'] as $user)
                            <li class="list-group-item">{{ $user->name }} – {{ $user->email }} – {{ $user->role }}</li>
                              @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-secondary text-white">
                            <i class="bi bi-journal-text me-1"></i> Recent Tasks
                        </div>
                        
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Fix API bug – <span class="badge bg-success">Completed</span></li>                           
                            <li class="list-group-item">Add export feature – <span class="badge bg-warning">In Progress</span></li>
                            <li class="list-group-item">Client feedback review – <span class="badge bg-secondary">Pending</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
