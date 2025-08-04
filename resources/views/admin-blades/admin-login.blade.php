{{-- Inheriting blade template from layout.blade.php file --}}

@extends('layout')

@section('title')
 Admin Login
@endsection

@section('content')

              {{-- <form action="{{ route('login') }}" method="POST"> --}}
                <form method="POST" action="{{ route('admin-process-login') }}">
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
                Admin Login
                </button>
            <a href="{{ route('admin-signup') }}" class="btn btn-outline-primary px-5 py-2 fw-semibold shadow-sm">
                Admin Sign-Up
            </a>
        </div>

<div class="d-flex justify-content-center mt-4">
    <a href="{{ route('select-type-of-user') }}" class="btn btn-secondary px-5 py-2 fw-semibold shadow-sm">
        <i class="bi bi-arrow-left-circle me-1"></i> Back to Role Selection
    </a>
</div>



              </form>
@endsection



{{-- Code written below is just for practice --}}
{{-- <form action="" method="">
    @csrf
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" name="" id="" required>
</form> --}}