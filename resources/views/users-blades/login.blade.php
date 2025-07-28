{{-- Inheriting blade template from layout.blade.php file --}}

@extends('layout')

@section('title')
 Login
@endsection

@section('content')

              <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="useremail" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="useremail" required> 
                </div>
                <div class="mb-3">
                    <label for="userpassword" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="userpassword" required> 
                </div>
               <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-4">
                <button type="submit" class="btn btn-success px-5 py-2 fw-semibold shadow-sm">
                    Login
                </button>
            <a href="{{ route('user-signup') }}" class="btn btn-outline-primary px-5 py-2 fw-semibold shadow-sm">
                Sign Up
            </a>
        </div>

              </form>
@endsection