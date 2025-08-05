@extends('layout')

@section('title', 'Admin Settings')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold">⚙️ Admin Settings</h2>

    <ul class="nav nav-tabs mb-3" id="settingsTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button">Profile</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="task-tab" data-bs-toggle="tab" data-bs-target="#task" type="button">Task Settings</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="appearance-tab" data-bs-toggle="tab" data-bs-target="#appearance" type="button">Appearance</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button">Security</button>
        </li>
    </ul>

    <div class="tab-content" id="settingsTabContent">
        <!-- Profile Settings -->
        <div class="tab-pane fade show active" id="profile" role="tabpanel">
            <form method="POST" action="">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Admin Name</label>
                    <input type="text" class="form-control" name="name" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label">Admin Email</label>
                    <input type="email" class="form-control" name="email" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label">Change Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <button class="btn btn-primary">Update Profile</button>
            </form>
        </div>

        <!-- Task Settings -->
        <div class="tab-pane fade" id="task" role="tabpanel">
            <form method="POST" action="">
                @csrf
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="enable_deadlines" id="enable_deadlines">
                    <label class="form-check-label" for="enable_deadlines">
                        Enable Deadlines
                    </label>
                </div>
                <div class="mb-3">
                    <label class="form-label">Max Tasks Per User</label>
                    <input type="number" class="form-control" name="max_tasks" value="10">
                </div>
                <button class="btn btn-success">Save Task Settings</button>
            </form>
        </div>

        <!-- Appearance Settings -->
        <div class="tab-pane fade" id="appearance" role="tabpanel">
            <form method="POST" action="">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Theme</label>
                    <select class="form-select" name="theme">
                        <option value="light">Light</option>
                        <option value="dark">Dark</option>
                    </select>
                </div>
                <button class="btn btn-secondary">Update Appearance</button>
            </form>
        </div>

        <!-- Security Settings -->
        <div class="tab-pane fade" id="security" role="tabpanel">
            <form method="POST" action="">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Session Timeout (minutes)</label>
                    <input type="number" class="form-control" name="timeout" value="10">
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="captcha_enabled" id="captcha_enabled">
                    <label class="form-check-label" for="captcha_enabled">
                        Enable CAPTCHA on Login
                    </label>
                </div>
                <button class="btn btn-danger mt-3">Update Security</button>
            </form>
        </div>
    </div>
</div>
@endsection
