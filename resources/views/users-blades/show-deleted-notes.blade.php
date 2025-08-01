{{-- Inheriting blade template from layout.blade.php file --}}

@extends('layout')

@section('title')
 All Deleted Notes
@endsection

@section('content')

@if ($notes->isEmpty())
    {{-- Leave this section empty intentionally Just to dela with javascript --}}
@endif
                  
@if (!$notes->isEmpty())

                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Restore</th> 
                        <th>Delete Permanently</th>                  
                    </tr>
                   @foreach ($notes as $note)
                    <tr>
                        <td>{{ $note->id }}</td>
                        <td><h6>{{ $note->title }}</h6></td>
                        <td>
                        <form action="{{ route('restore-single-note', $note->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Restore</button>
                        </form>
                        </td>
                        <td>
                    <div onclick="confirmDelete({{ $note->id }})" style="cursor: pointer;">
                            <button type="button" class="btn btn-danger">Delete</button>
                    </div>

        <form id="delete-form-{{ $note->id }}" action="{{ route('force-delete', $note->id) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
        </td>          
            </tr>
@endforeach

                </table>
                @endif
      <a href="{{ route('notes-dashboard') }}" class="btn btn-outline-primary px-5 py-2 fw-semibold shadow-sm">
                Go Back
            </a>


<script>
    function confirmDelete(noteId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to undo this!',
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
    }
</script>

@endsection

@section('scripts')
    @if ($notes->isEmpty())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'info',
                    title: 'No Notes Found',
                    text: 'You have no notes to display.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // window.history.back();
                     window.location.href = "{{ route('notes-dashboard') }}";
                });
            });
        </script>
    @endif
@endsection