{{-- Inheriting blade template from layout.blade.php file --}}

@extends('layout')

@section('title')
 All Notes
@endsection

@section('content')

                <a href="{{ route('add-note') }}" class="btn btn-success mb-3 mt-3">Add New</a>

                
<!-- Single Note View Modal -->
<div class="modal fade" id="singleNoteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="singleNoteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="singleNoteLabel">Single Note Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

{{-- Modal For Update Button --}}
<div class="modal fade" id="updateNoteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateNoteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="updateNoteLabel">Update Note Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="updateForm">
      <div class="modal-body">         
            <input type="hidden" id="postId" class="form-control" value="">
            <b>Title</b><input type="text" id="postTitle" class="form-control" value="">
            <b>Description</b><input type="text" id="postBody" class="form-control" value="">
            <img id="showImage" width="150px">
            <p>Upload Image</p><input type="file" id="postImage" class="form-control" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        <input type="submit" value="Save Changes" class="btn btn-warning">
      </div>
        </form>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

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
                        <td><img src={{ asset('uploads/' . $note->image) }} width="150px"/></td> 
                        <td><h6>{{ $note->title }}</h6></td>
                        <td>{{ $note->description }}</td>
                        {{-- <td><a href="{{ route('users.show' , $user->id) }}" class="btn btn-primary btn-sm">View</a></td> --}}
                        {{-- <td><a href="" class="btn btn-primary btn-sm">View</a></td>
                         <td><a href="" class="btn btn-warning btn-sm">Update</a></td>   --}}
                          <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#singleNoteModal">View</button>
                        </td>
                        <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"  data-bs-note="{{ $note->id }}" data-bs-target="#updateNoteModal">Update</button>
                        </td> 
                        <td>
                            <form action="" method="POST">
                                @csrf
                                @method('DELETE')
                                 <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>                       
                    </tr>                        
                    @endforeach
                </table>

@endsection