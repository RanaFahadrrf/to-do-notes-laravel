
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To Do Notes</title>
</head>
<body>

    @auth
{{-- Navbar --}}
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        {{-- <a class="navbar-brand" href="#">ToDo Notes</a> --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <!-- Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle btn btn-outline-secondary" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown">
            Account
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
            {{-- <li><a href="{{ route('showprofile') }}" class="dropdown-item" href="">My Profile</a></li> --}}
            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#profileModal">My Profile</a></li>

            <li>
              {{-- <form id="logout-form" action="" method="POST">
                @csrf
                <button type="submit" class="dropdown-item">Logout</button>
              </form> --}}
              <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    </div>
</nav>
 @endauth
{{-- Full-width Container --}}
<div class="container-fluid">
    <div class="bg-success-subtle text-center py-2">
        <h2>To-Do Notes</h2>
    </div>

    <div class="bg-warning-subtle text-center mb-3">
        <h4>@yield('title')</h4>
    </div>

    @if(session('status'))
        <div class="alert alert-success mx-2">
            {{ session('status') }}
        </div>
    @endif

    <div class="px-3">
        @yield('content')
    </div>
</div>

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const noteId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to undo this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + noteId).submit();
                    }
                });
            });
        });
    });
</script>
@auth
<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content shadow">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="profileModalLabel">My Profile</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row align-items-center">
          {{-- <div class="col-md-4 text-center mb-3">
            <img src="{{ asset('uploads/' . Auth::user()->image) }}" class="img-thumbnail rounded-circle" width="150" alt="Profile Image">
          </div> --}}
          <div class="col-md-8">
            <h4><strong>Welcome </strong>{{ Auth::user()->name }}</h4>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Joined:</strong> {{ Auth::user()->created_at->format('d M Y') }}</p>
            {{-- Add more fields if needed --}}
          </div>
        </div>
      </div>
      <div class="modal-footer bg-light">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        {{-- You can add an Edit Profile button here if needed --}}
      </div>
    </div>
  </div>
</div>
@endauth
@yield('scripts')
</body>
</html>
