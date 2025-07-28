<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add New Note</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2>Add New Note</h2>
  <form action="{{ route('notes.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="title" class="form-label">Title:</label>
      <input type="text" class="form-control" id="title" name="title" required>
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Description:</label>
      <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
    </div>

    <div class="mb-3">
      <label for="image" class="form-label">Upload Image or File:</label>
      <input class="form-control" type="file" id="image" name="image" required>
    </div>

    <button type="submit" class="btn btn-primary">Save Note</button>
    <a href="{{ url()->previous() }}" class="btn btn-danger">Go Back</a>
  </form>
</div>


</body>
</html>
