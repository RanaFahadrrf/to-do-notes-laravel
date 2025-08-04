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
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 crm-sidebar">
            <h4 class="text-center mb-4"><i class="bi bi-kanban-fill me-1"></i>To-Do CRM</h4>
            <a href="#" class="active"><i class="bi bi-house-door-fill me-2"></i> Dashboard</a>
            <a href="#"><i class="bi bi-person-lines-fill me-2"></i> Users</a>
            <a href="#"><i class="bi bi-card-checklist me-2"></i> Tasks</a>
            <a href="#"><i class="bi bi-gear-fill me-2"></i> Settings</a>
            <a href="{{ route('logout') }}"><i class="bi bi-box-arrow-left me-2"></i> Logout</a>
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
                        <h3>125</h3>
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
                            <li class="list-group-item">Ali Raza – ali@todo.com</li>
                            <li class="list-group-item">Fatima Noor – fatima@todo.com</li>
                            <li class="list-group-item">Bilal Khan – bilal@todo.com</li>
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
