{{-- Inheriting blade template from layout.blade.php file --}}

@extends('layout')

@section('title')
Admin Sign-Up
@endsection

@section('content')

              <form action="{{ route('admin-process-signup') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="username"> 
                </div>
                <div class="mb-3">
                    <label for="useremail" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="useremail"> 
                </div>
                 {{-- <div class="mb-3">
                    <label for="userrole" class="form-label" value="admin">Role</label>                  
                    </select>
                </div> --}}
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
                 Admin Sign-Up
                </button>
             <a href="{{ route('admin-login') }}" class="btn btn-outline-primary px-5 py-2 fw-semibold shadow-sm">
                Admin Login
            </a>
        </div>
              </form>
@endsection