{{-- Inheriting blade template from layout.blade.php file --}}

@extends('layout')

@section('title')
 All Notes
@endsection

@section('content')

     <a href="{{ route('add-note') }}" class="btn btn-success mb-3 mt-3">Add New Note</a>
     <a href="{{ route('show-deleted-notes') }}" class="btn btn-danger mb-3 mt-3">Show Deleted Notes</a>
      



                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>View</th>
                        <th>Update</th>
                        <th>Delete</th>                  
                    </tr>
                   @foreach ($notes as $note)
                    <tr>
                        {{-- <td><img src={{ asset('uploads/' . $note->image) }} width="150px"/></td> --}}
                     
                        <td>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#viewNoteModal{{ $note->id }}">
                        <img src="{{ asset('uploads/' . $note->image) }}" width="150px" class="img-thumbnail" style="cursor: pointer;" />
                        </td>
                        </a>
                        <td><h6>{{ $note->title }}</h6></td>
                        <td>{{ $note->description }}</td>
                        <td>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewNoteModal{{ $note->id }}">
            View
        </button>
        <!-- Edit Modal -->
        <div class="modal fade" id="viewNoteModal{{ $note->id }}" tabindex="-1" aria-labelledby="viewNoteModalLabel{{ $note->id }}" aria-hidden="true">
          <div class="modal-dialog">
                @method('PUT')
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="viewNoteModalLabel{{ $note->id }}">View Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                        <div class="mb-3">
                            <label>Title</label>
                            <p class="form-control">{{ $note->title }}</p>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <p class="form-control">{{ $note->description }}</p>
                        </div>
                        <div class="mb-3">
                        <label>Current Image</label><br>
                        <img src="{{ asset('uploads/' . $note->image) }}" alt="Note Image" width="150px" class="mb-2">
                    </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
          </div>
        </div>
    </td>
      @php
            $disabled = $note->status == 'pending';
            $button_color = 'btn btn-warning';
      
           if($note->status == 'pending')
              $button_color = 'btn btn-danger';
           else
               
             $button_color = 'btn btn-warning';
           @endphp
        <!-- Button trigger modal -->
               <td>
               {{-- <button type="button" class="{{ $button_color }}" data-bs-toggle="modal" data-bs-target="#editNoteModal{{ $note->id }}">
                 Update
             </button> --}}
             <div 
                @if($disabled)
                    onclick="showDisabledMessage()" 
                    style="cursor: not-allowed;"
                @endif
            >
                <button 
                    type="button" 
                    class="btn btn-warning {{ $disabled ? 'opacity-50' : '' }}" 
                    data-bs-toggle="{{ $disabled ? '' : 'modal' }}" 
                    data-bs-target="{{ $disabled ? '' : '#editNoteModal' . $note->id }}"
                    {{ $disabled ? 'disabled' : '' }}
                >
                    Update
                </button>
            </div>
        <!-- Edit Modal -->
        <div class="modal fade" id="editNoteModal{{ $note->id }}" tabindex="-1" aria-labelledby="editNoteModalLabel{{ $note->id }}" aria-hidden="true">
          <div class="modal-dialog">
            <form action="{{ route('notes.update', $note->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="editNoteModalLabel{{ $note->id }}">Edit Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $note->title }}" required>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" required>{{ $note->description }}</textarea>
                        </div>
                        <div class="mb-3">
                        <label>Current Image</label><br>
                        <img src="{{ asset('uploads/' . $note->image) }}" alt="Note Image" width="150px" class="mb-2">
                    </div>
                    <div class="mb-3">
                        <label>Change Image (optional)</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
            </form>
          </div>
        </div>
    </td>

      {{-- <td>
       
    <form action="{{ route('notes.destroy', $note->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                 <script>
             const confirmDelete = confirm("Are you sure you want to delete this post?");
                if (!confirmDelete) {
                    return; // Do nothing if user cancels
                }
            </script>
                                 <button type="submit" class="btn btn-danger">Delete</button>
    </form>
      
      </td> --}}
      {{-- <td>
    <form action="{{ route('notes.destroy', $note->id) }}" method="POST" onsubmit="return confirmDelete()">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</td>

@push('scripts')
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this note?");
    }
</script>
@endpush --}}
<td>
    {{-- <button type="button" class="btn btn-danger delete-btn" data-id="{{ $note->id }}">
        Delete
    </button> --}}
    {{-- Below is the code for delete-button including javascript --}}
        <div 
            @if($disabled)
                onclick="showDisabledMessage()" 
                style="cursor: not-allowed;"
            @else
                onclick="confirmDelete({{ $note->id }})"
                style="cursor: pointer;"
            @endif
        >
            <button 
                type="button" 
                class="btn btn-danger {{ $disabled ? 'opacity-50' : '' }}" 
                {{ $disabled ? 'disabled' : '' }}
            >
                Delete
            </button>
        </div>

        <form id="delete-form-{{ $note->id }}" action="{{ route('notes.destroy', $note->id) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>

</td>




</tr>
@endforeach

                </table>
<script>
    function showDisabledMessage() {
        Swal.fire({
            icon: 'info',
            title: 'Action not allowed. Pending approval from admin',
            text: 'This note is marked as completed and cannot be edited.',
            confirmButtonColor: '#3085d6'
        });
    }
</script>
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