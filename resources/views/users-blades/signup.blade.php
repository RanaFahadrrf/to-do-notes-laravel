{{-- Inheriting blade template from layout.blade.php file --}}

@extends('layout')

@section('title')
 Add New User
@endsection

@section('content')

              <form action="{{ route('signup') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="username"> 
                </div>
                <div class="mb-3">
                    <label for="useremail" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="useremail"> 
                </div>
                  <div class="mb-3">
                    <label for="userage" class="form-label">Age</label>
                    <input type="number" class="form-control" name="age" id="userage"> 
                </div>
                 <div class="mb-3">
                    <label for="userrole" class="form-label">Role</label>
                    <select class="form-select" name="role" id="userrole" required>
                        <option value="" selected disabled>Select a role</option>
                        <option value="editor">Editor</option>
                        <option value="reader">Reader</option>
                        <option value="guest">Guest</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="userpassword" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="userpassword"> 
                </div>
                <div class="mb-3">
                    <label for="userpassword-confirm" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="userpassword"> 
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-4">
                <button type="submit" class="btn btn-success px-5 py-2 fw-semibold shadow-sm">
                  Signup
                </button>
            <a href="{{ route('login-page') }}" class="btn btn-outline-primary px-5 py-2 fw-semibold shadow-sm">
                Login
            </a>
        </div>
              </form>
@endsection